<?php

namespace App\Filament\Admin\Resources;

use App\Configuration\Admin as SliderConfig;
use App\Models\Booking;
use App\Models\City;
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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Booking';

    protected static ?int $navigationSort = 7;


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
                            ->maxLength(255),
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


    /**
     * Agent Pages
     *
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\BookingResource\Pages\ListBooking::route('/'),
            'view' => \App\Filament\Admin\Resources\BookingResource\Pages\ViewBooking::route('/{record}'),
            'edit' => \App\Filament\Admin\Resources\BookingResource\Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
