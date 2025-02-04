<?php

namespace App\Filament\Admin\Resources;

use App\Configuration\Admin as SliderConfig;
use App\Models\City;
use App\Models\Company;
use App\Models\Service;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'City';

    protected static ?int $navigationSort = 3;


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
                            ->reactive()
                            ->debounce(700)
                            ->afterStateUpdated(function (callable $set, $state) {
                                $set('slug', Str::slug($state));
                            })
                            ->maxLength(255),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(table: City::class, column: 'slug', ignoreRecord: true)
                            ->maxLength(255),
                    ]),

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
            'index' => \App\Filament\Admin\Resources\CityResource\Pages\ListCity::route('/'),
            'create' => \App\Filament\Admin\Resources\CityResource\Pages\CreateCity::route('/create'),
            //'view' => \App\Filament\Admin\Resources\CityResource\Pages\ViewSlider::route('/{record}'),
            'edit' => \App\Filament\Admin\Resources\CityResource\Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
