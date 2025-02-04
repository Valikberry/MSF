<?php

namespace App\Filament\Admin\Resources\BranchResource\Pages;

use App\Enums\ServiceMeasureType;
use App\Filament\Admin\Resources\AgentResource;
use App\Filament\Admin\Resources\BranchResource;
use App\Filament\Admin\Resources\CompanyResource;
use App\Models\Branch;
use App\Models\Service;
use Filament\Actions;
use Filament\Actions\Action;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;


class ListBranch extends ListRecords
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add Branch')->icon('heroicon-o-plus'),
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
            ->defaultSort('company.name')
            ->columns([
                TextColumn::make('company.name')
                    ->sortable(),
                TextColumn::make('city.name')
                    ->sortable(),
                ImageColumn::make('image'),
            ])
            ->filters([])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->modalHeading('Delete Branch')
                        ->modalDescription(fn($record) => 'Are you sure to delete this branch?')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Success !!!')
                                ->body('Branch deleted successfully')
                        )
                        ->after(fn(Branch $record) => EditBranch::afterDelete($record)),
                ]),
            ])
            ->recordUrl(null);
    }

}
