<?php

namespace App\Livewire\Frontend;

use App\Enums\BookingStep;
use App\Enums\PaymentMethod;
use App\Libraries\Booking\BookingSession;
use App\Mail\BookingConfirmationToCustomer;
use App\Models\Booking;
use App\Models\City;
use App\Models\MovingItem;
use App\Services\Whatsapp\WhatsappMessage;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Component;

class PaymentForm extends Component
{
    public string $payment_method = '';

    public int $consent = 0;

    public int $terms = 0;


    public function mount(): void
    {
        $this->initPreviousData();
    }

    #[On('refresh-moving-detail')]
    public function refresh(): void
    {

    }


    public function render()
    {
        return view('livewire.frontend.payment-form');
    }

    public function storePaymentForm()
    {
        $this->validate([
            'payment_method' => [
                'required',
                Rule::in(PaymentMethod::names()),
                function (string $attribute, mixed $value, Closure $fail) {
                    if (getCartTotalQuantity() == 0) {
                        $fail(__('Cart is empty. Please select one of the services and then continue processing'));
                    }
                },
            ],
            'terms' => ['required', Rule::in(1)],
            'consent' => ['required', Rule::in(1)],
        ], [
            'payment_method.required' => __('Please select one of the payment method'),
            'payment_method.in' => __('Please method is invalid'),
        ]);

        $booking = $this->registerBooking();
        $this->clearBookingSession();

        Mail::to($booking->email)->send(new BookingConfirmationToCustomer($booking));

        if (isWhatsappSmsEnabled()) {
            WhatsappMessage::send($booking->whatsapp_no, "Dear ".$booking->name."\nBooking #".$booking->id." is confirmed");
        }

        //session()->flash(BookingConfirmationModal::SESSION_KEY, $booking->id);
        return redirect()->route('booking.view', ['id' => $booking->uid]);
    }

    protected function fields(): array
    {
        return ['payment_method'];
    }


    public function goToPrevious()
    {
        BookingSession::update(['step' => BookingStep::moving_object->value]);
        return redirect()->to(route('booking.process'));
    }


    private function initPreviousData(): void
    {
        $session = getBookingSession();

        if (isset($session['payment_method'])) {
            $this->payment_method = $session['payment_method'];
        }
    }


    protected function registerBooking(): mixed
    {
        $form = $this->all();
        $paymentMethod = $form['payment_method'];
        $session = getBookingSession();

        $movingItems = MovingItem::select('id', 'name')->whereIn('id', $session['moving_items'])->get()->toArray();

        $data = array_merge($session, [
            'uid' => strtolower(Str::random(16)),
            'phone_code' => getPhoneCode(),
            'moving_items' => $movingItems,
            'payment_method' => $paymentMethod,
            'total' => getCartTotalPrice(),
        ]);

        return Booking::create(Arr::only($data, Booking::fillableProps()));
    }

    protected function clearBookingSession(): void
    {
        BookingSession::removeSession();
    }
}






