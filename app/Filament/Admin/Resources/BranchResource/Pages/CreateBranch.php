<?php

namespace App\Filament\Admin\Resources\BranchResource\Pages;

use App\Filament\Admin\Resources\BranchResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateBranch extends CreateRecord
{
    protected static string $resource = BranchResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = is_array($value) ? getDataForJsonField($value) : $value;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.branches.index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success !!!')
            ->body('New branch created successfully.');
    }


}
