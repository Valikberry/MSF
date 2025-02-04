<?php

namespace App\Filament\Admin\Resources\BranchResource\Pages;

use App\Filament\Admin\Resources\BranchResource;
use App\Filament\Admin\Resources\CompanyResource;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Service;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditBranch extends EditRecord
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.branches.index');
    }

    protected function beforeSave(): void
    {
        $media = $this->data['image'];

        if (count($media) == 0) {
            return;
        }

        $images = array_values($media);

        if ($images[0] == $this->record->image) {
            return;
        }

        self::afterDelete($this->record);
    }


    public static function afterDelete(Branch $branch): void
    {
        if ($branch->image) {
            if (Storage::disk(\App\Configuration\Admin::getBranchMediaDisk())->exists($branch->image)) {
                Storage::disk(\App\Configuration\Admin::getBranchMediaDisk())->delete($branch->image);
            }
        }
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }


}
