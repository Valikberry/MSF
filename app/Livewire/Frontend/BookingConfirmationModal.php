<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\On;

class BookingConfirmationModal extends Component
{
    const SESSION_KEY = 'open-booking-confirmation';

    public bool $modal = false;

    #[On('open-booking-confirmation')]
    public function openModal(): void
    {
        $this->modal = true;
        $this->dispatch('openMoverModal');
    }

    #[On('close-booking-confirmation')]
    public function closeModal(): void
    {
        $this->modal = false;
        $this->dispatch('closeMoverModal');
    }



    public function render()
    {
        if (session()->has(self::SESSION_KEY)) {
            $bookingId = session(self::SESSION_KEY);
            $this->openModal();
        }

        return view('livewire.frontend.booking-confirmation-modal');
    }


}
