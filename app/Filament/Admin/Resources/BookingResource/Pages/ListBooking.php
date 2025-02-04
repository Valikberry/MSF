<?php

namespace App\Filament\Admin\Resources\BookingResource\Pages;

use App\Enums\PaymentMethod;
use App\Filament\Admin\Resources\BookingResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;


class ListBooking extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make()->label('Add Booking')->icon('heroicon-o-plus'),
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
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone_no')
                    ->sortable()
                    ->searchable()
                    /*->getStateUsing(function (Model $record) {
                        return new HtmlString($record->phone_no."<br>".$record->whatsapp_no);
                    })*/
                ,
                TextColumn::make('moving_date')
                    ->sortable()
                    ->getStateUsing(function (Model $record) {
                        return new HtmlString(date('d.m.Y', strtotime($record->moving_date)).' - '.getReadableTime($record->moving_time));
                    })
                ,
                TextColumn::make('total')
                    ->prefix(getCurrencySymbol())
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->getStateUsing(function (Model $record) {
                        return PaymentMethod::getName($record->payment_method);
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Registered at')
                    ->sortable()
                    ->getStateUsing(function (Model $record) {
                        return new HtmlString(date('d.m.Y - h:i A', strtotime($record->created_at)));
                    })
            ])
            ->filters([])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    //EditAction::make(),
                    DeleteAction::make()
                        ->modalHeading('Delete Booking !!!')
                        ->modalDescription(fn($record) => 'Are you sure to delete "'.$record->name.' ('.$record->phone_no.')'.'"?')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Success !!!')
                                ->body('Booking deleted successfully')
                        ),
                ]),
            ])
            //->recordUrl(null)
            ;
    }

}
