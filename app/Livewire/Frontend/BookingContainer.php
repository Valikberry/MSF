<?php

namespace App\Livewire\Frontend;

use App\Enums\BookingStep;
use App\Libraries\Alert\AlertMessage;
use App\Libraries\Booking\BookingSession;
use Livewire\Attributes\On;
use Livewire\Component;

class BookingContainer extends Component
{
    public string $step = "";
    protected mixed $session;

    public function mount(): void
    {
        $this->setCurrentStep();
    }

    #[On('refresh-booking-container')]
    public function refresh(): void
    {
        $this->setCurrentStep();
    }

    public function render(): mixed
    {
        $sliders = \App\Models\Slider::active()->orderBy('sort_order')->get();

        return view('livewire.frontend.booking-container', compact('sliders'));
    }

    #[On('go-to-next')]
    public function goToNext(array $form = []): void
    {
        BookingSession::update($form);
        $this->step = BookingSession::getStep();
    }


    #[On('go-to-previous')]
    public function goToPrevious(): void
    {
        $previousStep = 1;

        if (getBookingStep() == BookingStep::payment->value) {
            $previousStep = BookingStep::moving_object->value;
        }
        if (getBookingStep() == BookingStep::moving_object->value) {
            $previousStep = BookingStep::location->value;
        }
        if (getBookingStep() == BookingStep::location->value) {
            $previousStep = BookingStep::contact->value;
        }
        if (getBookingStep() == BookingStep::contact->value) {
            $previousStep = BookingStep::service->value;
        }

        BookingSession::update(['step' => $previousStep]);
        $this->step = $previousStep;
    }


    #[On('validate-service-next')]
    public function validateServiceAndNext(): void
    {
        if (getCartTotalQuantity() == 0) {
            AlertMessage::error(__('Cart is empty!!!'), __('Please fill cart with services'));
            return;
        }

        $this->goToNext();
    }


    protected function setCurrentStep(): void
    {
        $this->session = BookingSession::getSession();
        $this->step = $this->session['step'];
    }

    #[On('mover_alert')]
    public function alert($error): void
    {
        if (isset($error['status']) && $error['status'] == 1 && isset($error['message']) && strlen($error['message']) > 0) {
            AlertMessage::success($error['message']);
        }

        if (isset($error['status']) && $error['status'] == 0 && isset($error['message']) && strlen($error['message']) > 0) {
            AlertMessage::error($error['message']);
        }

    }


}
