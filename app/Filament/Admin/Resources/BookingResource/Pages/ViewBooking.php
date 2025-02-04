<?php

namespace App\Filament\Admin\Resources\BookingResource\Pages;

use App\Enums\PaymentMethod;
use App\Filament\Admin\Resources\BookingResource;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('id')->label('ID')->prefix('#')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('name')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('email')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('phone_no')->prefix(getPhoneCode()." - ")->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('whatsapp_no')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('moving_date')
                        ->getStateUsing(function (Model $record) {
                            return new HtmlString(date('d M Y', strtotime($record->moving_date)).' - '.getReadableTime($record->moving_time));
                        })
                        ->inlineLabel(),
                ]),
                Grid::make(['xl' => 1])->schema([
                    RepeatableEntry::make('services')
                        ->schema([
                            TextEntry::make('city_name')->label('City'),
                            TextEntry::make('company_name')->label('Company'),
                            TextEntry::make('service_name')->label('Service'),
                            TextEntry::make('price')->prefix(getCurrencySymbol()),
                            TextEntry::make('quantity'),
                            TextEntry::make('total')->prefix(getCurrencySymbol()),
                        ])
                        ->columns(6)
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('total')->prefix(getCurrencySymbol())->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('payment_method')
                        ->inlineLabel()
                        ->getStateUsing(fn (Model $record) => PaymentMethod::getName($record->payment_method)),
                ]),
                Grid::make(['xl' => 1])->schema([
                    RepeatableEntry::make('pick_locations')
                        ->schema([
                            TextEntry::make('address'),
                            TextEntry::make('floor'),
                        ])
                        ->columns(3)
                ]),
                Grid::make(['xl' => 1])->schema([
                    RepeatableEntry::make('drop_locations')
                        ->schema([
                            TextEntry::make('address'),
                            TextEntry::make('floor'),
                        ])
                        ->columns(3)
                ]),

                Grid::make(['xl' => 1])->schema([
                    TextEntry::make('moving_items')
                        ->getStateUsing(function (Model $record) {
                            $items = "<div class='moving-items'>";
                            foreach ($record->moving_items as $moving_item) {
                                $items .= "<span>".$moving_item['name']."</span>";
                            }
                            $items .= "</div>";
                            return new HtmlString($items);
                        }),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('description')->inlineLabel(),
                ]),

            ]);
    }



}
