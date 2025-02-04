<?php

namespace App\Filament\Admin\Resources;

use App\Models\MovingItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;

class MovingItemResource extends Resource
{
    protected static ?string $model = MovingItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationLabel = 'Moving Item';

    protected static ?int $navigationSort = 6;


    /**
     * Agent Form
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(250),
                    ]),

                /*Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->rows(5),
                    ]),*/

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->inline(false),
                    ]),
            ]);
    }


    /**
     * Agent Relations
     *
     * @return array
     */
    public static function getRelations(): array
    {
        return [

        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('name')->inlineLabel(),
                ]),
                /*Grid::make(['xl' => 2])->schema([
                    TextEntry::make('description')->inlineLabel(),
                ]),*/
                Grid::make(['xl' => 2])->schema([
                    IconEntry::make('is_active')->label('Status')->boolean()->inlineLabel(),
                ]),

            ]);
    }

    /**
     * Agent Pages
     *
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\MovingItemResource\Pages\ListMovingItem::route('/'),
            'create' => \App\Filament\Admin\Resources\MovingItemResource\Pages\CreateMovingItem::route('/create'),
            //'view' => \App\Filament\Admin\Resources\MovingItemResource\Pages\ViewMovingItem::route('/{record}'),
            'edit' => \App\Filament\Admin\Resources\MovingItemResource\Pages\EditMovingItem::route('/{record}/edit'),
        ];
    }
}
