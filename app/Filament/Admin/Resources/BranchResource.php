<?php

namespace App\Filament\Admin\Resources;

use App\Configuration\Admin as BranchConfig;
use App\Models\Branch;
use App\Models\City;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Branch';

    protected static ?int $navigationSort = 5;

    protected static bool $shouldRegisterNavigation = true;

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
                        Forms\Components\Select::make('company_id')
                            ->label('Company')
                            ->options(Company::orderBy('name')->get()->pluck('name', 'id'))
                            ->required()
                            ->native(false)
                            ->rules([
                                fn(Forms\Get $get, $context): \Closure => function (string $attribute, $value, \Closure $fail) use ($context, $get) {
                                    if ($get('city_id') > 0 && $value > 0) {
                                        $id = $get('id');
                                        $branch = Branch::where('city_id', $get('city_id'))
                                            ->where('company_id', $value)
                                            ->where(function ($query) use ($id) {
                                                if ($id) {
                                                    $query->where('id', '!=', $id);
                                                }
                                            })
                                            ->count();
                                        if ($branch > 0) {
                                            $fail("Branch already exists");
                                        }
                                    }
                                },
                            ]),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\Select::make('city_id')
                            ->label('City')
                            ->options(City::orderBy('name')->get()->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('owner_link')
                            ->label('Owner Form Link')
                            ->nullable()
                            ->maxLength(200),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->disk(BranchConfig::getBranchMediaDisk())
                            ->directory(BranchConfig::getBranchMediaDirectory())
                            ->preserveFilenames()
                            ->previewable()
                            ->openable()
                            ->required()
                            ->acceptedFileTypes(BranchConfig::getBranchMediaTypes())
                            ->minSize(BranchConfig::getBranchMediaMinSize())
                            ->maxSize(BranchConfig::getBranchMediaMaxSize())
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => (string)str($file->getClientOriginalName())
                                    ->prepend(now()->timestamp . '_'),
                            ),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Textarea::make('short_description')
                            ->nullable()
                            ->rows(5)
                            ->maxLength(500),
                    ]),

                Section::make('Infolist List')
                    ->schema([
                        Repeater::make('infolist')
                            ->label('')
                            ->schema([
                                TextInput::make('label')->label('Label')->nullable(),
                                Textarea::make('value')->label('Detail')->nullable(),
                            ])
                            ->columns(2),
                    ])
                    ->collapsed(),

                Section::make('Contact List')
                    ->schema([
                        Repeater::make('contacts')
                            ->label('')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->options(BranchConfig::getContactTypes())
                                    ->searchable()
                                    ->nullable()
                                    ->native(false),
                                TextInput::make('value')
                                    ->label('Detail')
                                    ->maxLength(200)
                                    ->nullable(),
                            ])
                            ->columns(2),
                    ])
                    ->collapsed(),

                Section::make('Availability List')
                    ->schema([
                        Repeater::make('availability')
                            ->label('')
                            ->schema([
                                Forms\Components\TextInput::make('day')
                                    ->nullable()
                                    ->maxLength(20),
                                TextInput::make('value')
                                    ->label('Time')
                                    ->placeholder('6:00AM - 10:00PM')
                                    ->maxLength(20)
                                    ->nullable(),
                            ])
                            ->columns(2),
                    ])
                    ->collapsed(),

                RichEditor::make('description')
                    ->maxLength(1000)
                    ->nullable()
                    ->columnSpanFull(),

                Section::make('Services')
                    ->schema([
                        Repeater::make('services')
                            ->relationship()
                            ->label('')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(200),
                                Forms\Components\Select::make('type')
                                    ->options(\App\Enums\ServiceMeasureType::getSelectOption())
                                    ->required(),
                                TextInput::make('price')
                                    ->numeric(),
                            ])
                            ->columns(3),
                    ])
                    ->collapsed(),


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
                    TextEntry::make('company.name')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('city.name')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('short_description')->inlineLabel(),
                ]),
                Grid::make(['xl' => 2])->schema([
                    ImageEntry::make('image')->inlineLabel(),
                ]),
                RepeatableEntry::make('infolist')
                    ->schema([
                        Grid::make(['xl' => 3])
                            ->schema([
                                TextEntry::make('label')->label('Name')->inlineLabel()->columnSpan(1),
                                TextEntry::make('value')->label('Detail')->inlineLabel()->columnSpan(1),
                            ])
                    ])
                    ->columnSpanFull()
                    ->contained(false),
                RepeatableEntry::make('contacts')
                    ->schema([
                        Grid::make(['xl' => 3])
                            ->schema([
                                TextEntry::make('type')->label('Type')->inlineLabel()->columnSpan(1),
                                TextEntry::make('value')->label('Detail')->inlineLabel()->columnSpan(1),
                            ])
                    ])
                    ->columnSpanFull()
                    ->contained(false),
                RepeatableEntry::make('availability')
                    ->schema([
                        Grid::make(['xl' => 3])
                            ->schema([
                                TextEntry::make('day')->label('Day')->inlineLabel()->columnSpan(1),
                                TextEntry::make('value')->label('Time')->inlineLabel()->columnSpan(1),
                            ])
                    ])
                    ->columnSpanFull()
                    ->contained(false),
                Grid::make(['xl' => 2])->schema([
                    TextEntry::make('description')->inlineLabel()->html(),
                ]),
                RepeatableEntry::make('services')
                    ->schema([
                        Grid::make(['xl' => 3])
                            ->schema([
                                TextEntry::make('name')->label('Name')->inlineLabel()->columnSpan(1),
                                TextEntry::make('type')->label('Type')->inlineLabel()->columnSpan(1),
                                TextEntry::make('price')->label('Price')->inlineLabel()->columnSpan(1),
                            ])
                    ])
                    ->columnSpanFull()
                    ->contained(false),
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
            'index' => \App\Filament\Admin\Resources\BranchResource\Pages\ListBranch::route('/'),
            'create' => \App\Filament\Admin\Resources\BranchResource\Pages\CreateBranch::route('/create'),
            'edit' => \App\Filament\Admin\Resources\BranchResource\Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
