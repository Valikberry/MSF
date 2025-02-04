<?php

namespace App\Filament\Admin\Resources\CityResource\Pages;

use App\Filament\Admin\Resources\CityResource;
use App\Models\Slider;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditCity extends EditRecord
{
    protected static string $resource = CityResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.cities.index');
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }


}
