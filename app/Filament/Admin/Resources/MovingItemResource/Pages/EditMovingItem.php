<?php

namespace App\Filament\Admin\Resources\MovingItemResource\Pages;

use App\Filament\Admin\Resources\MovingItemResource;
use Filament\Resources\Pages\EditRecord;

class EditMovingItem extends EditRecord
{
    protected static string $resource = MovingItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.moving-items.index');
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }


}
