<?php

namespace App\Filament\Admin\Resources;

use App\Configuration\Admin as ServiceConfig;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Company';

    protected static ?int $navigationSort = 4;


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
                            ->unique(table: Company::class, column: 'slug', ignoreRecord: true)
                            ->maxLength(255),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->disk(ServiceConfig::getCompanyMediaDisk())
                            ->directory(ServiceConfig::getCompanyMediaDirectory())
                            ->preserveFilenames()
                            ->previewable()
                            ->openable()
                            ->required()
                            ->acceptedFileTypes(ServiceConfig::getCompanyMediaTypes())
                            ->minSize(ServiceConfig::getCompanyMediaMinSize())
                            ->maxSize(ServiceConfig::getCompanyMediaMaxSize())
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend(now()->timestamp.'_'),
                            ),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('main_service')
                            ->required()
                            ->maxLength(255),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\Grid::make(['sm' => 2])
                            ->schema([
                                Forms\Components\TextInput::make('rating')
                                    ->numeric()
                                    ->nullable(),
                                Forms\Components\TextInput::make('reviews')
                                    ->numeric()
                                    ->nullable(),
                            ])->columnSpan(1),

                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\Toggle::make('verified'),
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
                    TextEntry::make('main_service')
                        ->label('Service')
                        ->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    ImageEntry::make('logo')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('rating')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('reviews')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    IconEntry::make('verified')
                        ->boolean()
                        ->inlineLabel(),
                ]),
            ]);
    }

    /**
     * Service Pages
     *
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\CompanyResource\Pages\ListCompany::route('/'),
            'create' => \App\Filament\Admin\Resources\CompanyResource\Pages\CreateCompany::route('/create'),
            'edit' => \App\Filament\Admin\Resources\CompanyResource\Pages\EditCompany::route('/{record}/edit'),
        ];
    }

}
