<?php

namespace App\Filament\Admin\Resources\MovingItemResource\Pages;

use App\Filament\Admin\Resources\MovingItemResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMovingItem extends CreateRecord
{
    protected static string $resource = MovingItemResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.moving-items.index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success !!!')
            ->body('New Moving Object created successfully.');
    }


}
