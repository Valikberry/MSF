<?php

namespace App\Filament\Admin\Resources\CompanyResource\Pages;

use App\Filament\Admin\Resources\CompanyResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.companies.index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success !!!')
            ->body('New company created successfully.');
    }


}
