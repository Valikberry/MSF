<?php

namespace App\Livewire\Frontend;

use App\Enums\BookingStep;
use App\Libraries\Booking\BookingSession;
use App\Rules\Frontend\IsValidPhoneNo;
use Illuminate\Support\Arr;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone_no = '';
    public string $whatsapp_no = '';


    public function mount(): void
    {
        $this->initPreviousData();
    }

    #[On('refresh-contact')]
    public function refresh(): void
    {

    }


    public function render()
    {
        $session = getBookingSession();

        return view('livewire.frontend.contact-form', compact('session'));
    }


    protected function fields(): array
    {
        return ['name', 'email', 'phone_no', 'whatsapp_no'];
    }

    /**
     * Go to Homepage
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function goBackHome()
    {
        return redirect(url('/'));
    }


    public function storeContactForm()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone_no' => ['required', new IsValidPhoneNo(), 'min:7', 'max:15'],
            'whatsapp_no' => ['required', new IsValidPhoneNo(trans('Whatsapp number is not valid')), 'min:7', 'max:20'],
        ], [
            'name.required' => __('First name is required'),
            'email.required' => __('Email is required'),
            'email.email' => __('Email is invalid'),
            'phone_no.required' => __('Phone number is required'),
            'phone_no.max' => __('Phone number must not exceed 15 digits'),
            'phone_no.min' => __('Phone number is too short'),
            'whatsapp_no.required' => __('Whatsapp number is required'),
            'whatsapp_no.min' => __('Whatsapp number is too short'),
            'whatsapp_no.max' => __('Whatsapp number must not exceed 20 digits'),
        ]);

        BookingSession::update(
            array_merge(Arr::only($this->all(), $this->fields()), [
                'step' => BookingStep::location->value
            ])
        );

        return redirect(route('booking.process'));
    }


    public function resetForm(): void
    {
        $this->reset();
    }


    private function initPreviousData(): void
    {
        $session = getBookingSession();

        if (isset($session['name'])) {
            $this->name = $session['name'];
        }
        if (isset($session['email'])) {
            $this->email = $session['email'];
        }
        if (isset($session['phone_no'])) {
            $this->phone_no = $session['phone_no'];
        }
        if (isset($session['whatsapp_no'])) {
            $this->whatsapp_no = $session['whatsapp_no'];
        }
    }

}






