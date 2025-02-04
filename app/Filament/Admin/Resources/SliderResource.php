<?php

namespace App\Filament\Admin\Resources;

use App\Configuration\Admin as SliderConfig;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Slider';

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
                        Forms\Components\FileUpload::make('image')
                            ->disk(SliderConfig::getBannerImageDisk())
                            ->directory(SliderConfig::getBannerImageDirectory())
                            ->preserveFilenames()
                            ->previewable()
                            ->openable()
                            ->required()
                            ->acceptedFileTypes(SliderConfig::getBannerImageTypes())
                            ->minSize(SliderConfig::getBannerImageMinSize())
                            ->maxSize(SliderConfig::getBannerImageMaxSize())
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend(now()->timestamp.'_'),
                            ),
                    ]),

                Forms\Components\Grid::make(['sm' => 2])
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->rows(5),
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

    /**
     * Agent Pages
     *
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\SliderResource\Pages\ListSlider::route('/'),
            'create' => \App\Filament\Admin\Resources\SliderResource\Pages\CreateSlider::route('/create'),
            //'view' => \App\Filament\Admin\Resources\SliderResource\Pages\ViewSlider::route('/{record}'),
            'edit' => \App\Filament\Admin\Resources\SliderResource\Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
