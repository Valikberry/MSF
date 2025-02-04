<?php

namespace App\Filament\Admin\Resources\CompanyResource\Pages;

use App\Filament\Admin\Resources\CompanyResource;
use App\Models\Company;
use App\Models\Service;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.companies.index');
    }

    protected function beforeSave(): void
    {
        $media = $this->data['logo'];

        if (count($media) == 0) {
            return;
        }

        $images = array_values($media);

        if ($images[0] == $this->record->logo) {
            return;
        }

        self::beforeUpdate($this->record);
    }

    public static function beforeUpdate(Company $company)
    {
        if ($company->logo) {
            if (Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->exists($company->logo)) {
                Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->delete($company->logo);
            }
        }
    }


    public static function beforeDelete(Company $company): void
    {
        self::beforeUpdate($company);

        $branches = $company->branches;

        if ($branches->count() > 0) {

            foreach ($branches as $branch) {
                if (Storage::disk(\App\Configuration\Admin::getBranchMediaDisk())->exists($branch->image)) {
                    Storage::disk(\App\Configuration\Admin::getBranchMediaDisk())->delete($branch->image);
                }
            }
        }
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }


}
