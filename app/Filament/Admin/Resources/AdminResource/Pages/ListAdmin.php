<?php

namespace App\Filament\Admin\Resources\AdminResource\Pages;

use App\Filament\Admin\Resources\AdminResource;
use App\Models\Admin;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ListAdmin extends ListRecords
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add Admin')->icon('heroicon-o-plus'),
        ];
    }

    /**
     * Table Structure
     *
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone_no')
                    ->searchable()
                    ->sortable()
                    ->visibleFrom('md'),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
            ])
            ->filters([])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make()->visible(fn($record) => isAuthSuperAdmin()),
                    DeleteAction::make()
                        ->modalHeading('Delete Admin')
                        ->visible(fn($record) => isAuthSuperAdmin() && !in_array($record->email, getSuperAdminEmails()))
                        ->modalDescription(fn($record) => 'Are you sure to delete '.$record->name.'?')
                        ->successNotification(
                            Notification::make()->success()->title('Success !!!')->body('Agent deleted successfully')
                        )->after(fn(Admin $record) => EditSlider::afterDelete($record)),
                ]),
            ]
            )
            ->bulkActions([
                /*BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),*/
            ])
            ->recordUrl(null);
    }

}
