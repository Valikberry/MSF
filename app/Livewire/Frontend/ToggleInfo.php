<?php

namespace App\Livewire\Frontend;

use App\Libraries\Alert\AlertMessage;
use App\Libraries\Booking\BookingSession;
use App\Models\Branch;
use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ToggleInfo extends Component
{
    public bool $hide = true;
    public string $type = '';
    public string $text = '';

    public function render()
    {
        return view('livewire.frontend.__inc.info_toggle');
    }

    public function toggle(): void
    {
        $this->hide = !($this->hide);
    }



}






