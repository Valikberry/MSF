<?php

namespace App\Livewire\Frontend;

use App\Enums\BookingStep;
use App\Libraries\Booking\BookingSession;
use App\Models\City;
use Illuminate\Support\Arr;
use Livewire\Attributes\Computed;
use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;


class LocationForm extends Component
{
    #[Validate('required')]
    public array $pick_locations = [['address' => '', 'floor' => '']];

    #[Validate('required')]
    public array $drop_locations = [['address' => '', 'floor' => '']];

    #[Validate('required')]
    public string $moving_date = '';

    #[Validate('required')]
    public string $moving_time = '';

    public bool $isUpdated = false;

    public function mount(): void
    {
        $this->initPreviousData();
    }

    #[On('refresh-location')]
    public function refresh(): void
    {
    }

    public function render(): mixed
    {
        return view('livewire.frontend.location-form');
    }

    public function storeLocationForm()
    {
        $this->isUpdated = true;

        $this->validate([
            'pick_locations' => [
                'required',
                function ($attribute, $locations, $fail) {
                    foreach ($locations as $location) {
                        if (!isset($location['address'])) {
                            $fail('Pickup location address is required');
                            return;
                        }
                        if (strlen($location['address']) == 0) {
                            $fail('Pickup location address is required');
                            return;
                        }
                        if (!isset($location['floor'])) {
                            $fail('Pickup floor is required');
                            return;
                        }
                        if (strlen($location['floor']) == 0) {
                            $fail('Pickup floor is required');
                            return;
                        }
                    }
                }
             ],
            'drop_locations' => [
                'required',
                'min:1',
                function ($attribute, $locations, $fail) {
                    foreach ($locations as $location) {
                        if (!isset($location['address'])) {
                            $fail('Drop-off location address is required');
                            return;
                        }
                        if (strlen($location['address']) == 0) {
                            $fail('Drop-off location address is required');
                            return;
                        }
                        if (!isset($location['floor'])) {
                            $fail('Drop-off floor is required');
                            return;
                        }
                        if (strlen($location['floor']) == 0) {
                            $fail('Drop-off floor is required');
                            return;
                        }
                    }
                }
            ],
            'moving_date' => ['required', 'date'],
            'moving_time' => ['required', 'date_format:H:i'],
        ]);

        BookingSession::update(
            array_merge(Arr::only($this->all(), $this->fields()), [
                'step' => BookingStep::moving_object->value,
            ])
        );

        return redirect()->to(route('booking.process'));
    }


    public function goToPrevious()
    {
        BookingSession::update(['step' => BookingStep::contact->value]);
        return redirect()->to(route('booking.process'));
    }

    protected function fields(): array
    {
        return ['pick_locations', 'drop_locations', 'moving_date', 'moving_time'];
    }

    private function initPreviousData(): void
    {
        $session = getBookingSession();

        if (isset($session['pick_locations'])) {
            $this->pick_locations = (array) $session['pick_locations'];
        }
        if (isset($session['drop_locations'])) {
            $this->drop_locations = (array) $session['drop_locations'];
        }

        if (isset($session['moving_date'])) {
            $this->moving_date = (string) $session['moving_date'];
        }
        if (isset($session['moving_time'])) {
            $this->moving_time = (string) $session['moving_time'];
        }

    }

    public function addPickupLocation(): void
    {
        $this->pick_locations[] = [
            'address' => '',
            'floor' => ''
        ];
    }

    public function removePickupLocation(int $index): void
    {
        array_splice($this->pick_locations, $index, 1);
    }

    public function addDropoffLocation(): void
    {
        $this->drop_locations[] = [
            'address' => '',
            'floor' => ''
        ];
    }

    public function removeDropoffLocation(int $index): void
    {
        array_splice($this->drop_locations, $index, 1);
    }





}







