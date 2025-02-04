<?php

namespace App\Filament\Admin\Resources\CompanyResource\Pages;

use App\Enums\ServiceMeasureType;
use App\Filament\Admin\Resources\AgentResource;
use App\Filament\Admin\Resources\CompanyResource;
use App\Models\Company;
use App\Models\Service;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;


class ListCompany extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add Company')->icon('heroicon-o-plus'),
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
                ImageColumn::make('logo'),
                IconColumn::make('verified')
                    ->boolean(),
                TextColumn::make('rating'),
                TextColumn::make('reviews'),
            ])
            ->filters([])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->modalHeading('Delete Company')
                        ->modalDescription(fn($record) => 'Are you sure to delete "'.$record->name.'"?')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Success !!!')
                                ->body('Company deleted successfully')
                        )
                        ->before(fn(Company $record) => EditCompany::beforeDelete($record)),
                ]),
            ])
            ->recordUrl(null);
    }

}
