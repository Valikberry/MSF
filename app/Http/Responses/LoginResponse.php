<?php

namespace App\Http\Responses;


use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // You can use the Filament facade to get the current panel and check the ID
        if (Filament::getCurrentPanel()->getId() === 'admin') {
            return redirect()->to('/admin/login');
        }

        if (Filament::getCurrentPanel()->getId() === 'agent') {
            return redirect()->to('/agent/login');
        }

        return parent::toResponse($request);
    }
}