<?php

namespace App\Livewire\Frontend;

use App\Enums\BookingStep;
use App\Libraries\Booking\BookingSession;
use App\Models\City;
use App\Models\MovingItem;
use Illuminate\Support\Arr;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Component;

class MovingDetailForm extends Component
{
    public array $moving_items = [];

    public string $description = '';


    public function mount(): void
    {
        $this->initPreviousData();
    }

    #[On('refresh-moving-detail')]
    public function refresh(): void
    {

    }

    #[Computed]
    public function moving_items()
    {
        return MovingItem::active()->get();
    }

    public function render()
    {
        return view('livewire.frontend.moving-detail-form');
    }

    protected function fields(): array
    {
        return ['moving_items', 'description'];
    }

    public function storeMovingDetailForm()
    {
        $this->validate([
            'moving_items' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    $count = MovingItem::whereIn('id', $value)->count();
                    if ($count == 0) {
                        $fail(__('Moving items are invalid'));
                    }
                }
            ],
            'description' => ['required'],
        ], [
            'moving_items.required' => __('Please select at least one moving item'),
            'moving_items.array' => __('Moving items are invalid'),
            'description.required' => __('Please enter detail'),
        ]);

        BookingSession::update(
            array_merge(
                Arr::only($this->all(), $this->fields()),
                ['step' => BookingStep::payment->value]
            )
        );

        return redirect()->to(route('booking.process'));
    }

    public function resetForm(): void
    {
        $this->reset();
    }

    public function goToPrevious()
    {
        BookingSession::update(['step' => BookingStep::location->value]);
        return redirect()->to(route('booking.process'));
    }


    private function initPreviousData(): void
    {
        $session = getBookingSession();

        if (isset($session['moving_items'])) {
            $this->moving_items = $session['moving_items'];
        }
        if (isset($session['description'])) {
            $this->description = $session['description'];
        }
    }

}






