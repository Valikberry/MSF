<?php

namespace App\Filament\Admin\Resources\SliderResource\Pages;

use App\Filament\Admin\Resources\SliderResource;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewSlider extends ViewRecord
{
    protected static string $resource = SliderResource::class;

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
                    TextEntry::make('name')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    ImageEntry::make('image'),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('description')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    IconEntry::make('is_active')->label('Status')->boolean()->inlineLabel(),
                ]),

            ]);
    }



}
