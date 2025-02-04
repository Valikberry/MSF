<?php

namespace App\Filament\Admin\Resources\SliderResource\Pages;

use App\Filament\Admin\Resources\SliderResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSlider extends CreateRecord
{
    protected static string $resource = SliderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.sliders.index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success !!!')
            ->body('New slider created successfully.');
    }


}
