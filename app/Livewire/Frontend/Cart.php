<?php

namespace App\Livewire\Frontend;

use App\Enums\BookingStep;
use App\Libraries\Booking\BookingSession;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Attributes\On;

class Cart extends Component
{
    public bool $modal = false;
    public bool $hasAction = false;

    #[On('openCartModal')]
    public function openCart(): void
    {
        $this->dispatch('openMoverModal');
        $this->modal = true;
    }

    #[On('closeCartModal')]
    public function closeCart(): void
    {
        $this->dispatch('closeMoverModal');
        $this->modal = false;
    }

    public function closeCartAndNext()
    {
        $this->closeCart();

        if (getBookingStep() < BookingStep::contact->value) {
            BookingSession::update(['step' => BookingStep::contact->value]);
        }
        return redirect()->route('booking.process');
    }

    public function render()
    {
        return view('livewire.frontend.cart');
    }


    /**
     * Remove Cart Item
     *
     * @param int $serviceId
     * @return void
     */
    public function removeCartItem(int $serviceId): void
    {
        $cartItems = getCart();
        $newCartItems = [];

        foreach ($cartItems as $item) {
            if ($item['service_id'] != $serviceId) {
                $newCartItems[] = $item;
            }
        }

        BookingSession::update(['services' => $newCartItems]);

        $this->dispatch('refresh-service');
    }


    #[On('update-service-quantity')]
    public function updateServiceQuantity(array $data): void
    {
        $service = $data['service'];
        $cartItems = getCart();
        $exist = false;

        $quantity = max($data['quantity'], 0);

        $newCartItems = [];
        foreach ($cartItems as $item) {
            if ($item['id'] == $service['id']) {
                $exist = true;
                if ($quantity == 0) {
                    break;
                }
                $item['quantity'] = $quantity;
                $item['total'] = $item['quantity'] * $item['price'];
            }
            $newCartItems[] = $item;
        }

        if (!$exist && $quantity > 0) {
            $newCartItems[] = [
                'id' => $service['id'],
                'name' => $service['name'],
                'quantity' => $quantity,
                'price' => $service['price'],
                'total' => $service['price'] * $quantity,
            ];
        }

        BookingSession::update(['services' => $newCartItems]);
    }
}
