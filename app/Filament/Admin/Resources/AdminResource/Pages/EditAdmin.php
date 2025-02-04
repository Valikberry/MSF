<?php

namespace App\Filament\Admin\Resources\AdminResource\Pages;

use App\Models\Admin;
use App\Filament\Admin\Resources\AdminResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

    public static function canAccess(array $parameters = []): bool
    {
        return isAuthSuperAdmin();
    }

}
