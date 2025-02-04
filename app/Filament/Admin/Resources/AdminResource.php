<?php

namespace App\Filament\Admin\Resources;

use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Admin';

    protected static ?int $navigationSort = 1;


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

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->email()
                            ->unique(table: Admin::class, column: 'email', ignoreRecord: true),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->minLength(6)
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->revealable(),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('phone_no')
                            ->maxLength(15),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->inline(false),
                    ]),

            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('name')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('email')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('phone_no')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    IconEntry::make('is_active')->label('Status')->boolean()->inlineLabel(),
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
            'index' => \App\Filament\Admin\Resources\AdminResource\Pages\ListAdmin::route('/'),
            'create' => \App\Filament\Admin\Resources\AdminResource\Pages\CreateAdmin::route('/create'),
            //'view' => \App\Filament\Admin\Resources\AdminResource\Pages\ViewAdmin::route('/{record}'),
            'edit' => \App\Filament\Admin\Resources\AdminResource\Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
