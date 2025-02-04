<?php

namespace App\Filament\Admin\Resources\SliderResource\Pages;

use App\Filament\Admin\Resources\SliderResource;
use App\Models\Slider;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditSlider extends EditRecord
{
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.sliders.index');
    }

    protected function beforeSave(): void
    {
        $medias = $this->data['image'];

        if (count($medias) == 0) {
            return;
        }

        $images = array_values($medias);

        if ($images[0] == $this->record->image) {
            return;
        }

        self::afterDelete($this->record);
    }


    public static function afterDelete(Slider $slider): void
    {
        if (!$slider->image) {
            return;
        }

        if (Storage::disk(\App\Configuration\Admin::getBannerImageDisk())->exists($slider->image)) {
            Storage::disk(\App\Configuration\Admin::getBannerImageDisk())->delete($slider->image);
        }
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }


}
