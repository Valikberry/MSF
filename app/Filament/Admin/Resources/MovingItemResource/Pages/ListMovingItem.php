<?php

namespace App\Filament\Admin\Resources\MovingItemResource\Pages;

use App\Filament\Admin\Resources\MovingItemResource;
use App\Models\Slider;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;


class ListMovingItem extends ListRecords
{
    protected static string $resource = MovingItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add Moving Object')->icon('heroicon-o-plus'),
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
            ->defaultSort('sort_order', 'asc')
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                /*TextColumn::make('description')
                    ->sortable(),*/
                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                /*DownStepAction::make(),
                UpStepAction::make(),*/
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->modalHeading('Delete Moving Item !!!')
                        ->modalDescription(fn($record) => 'Are you sure to delete "'.$record->name.'"?')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Success !!!')
                                ->body('Moving Item deleted successfully')
                        ),
                ]),
            ])
            ->recordUrl(null);
    }

}
