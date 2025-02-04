<?php

namespace App\Filament\Admin\Auth;

use Illuminate\Contracts\Support\Htmlable;

class Login extends \Filament\Pages\Auth\Login
{

    public function getHeading(): string | Htmlable
    {
        return 'Admin Portal';
    }

    public function getTitle(): Htmlable|string
    {
        return 'Admin Login';
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'email'     => $data['email'],
            'password'  => $data['password'],
            'is_active' => 1
        ];
    }

}