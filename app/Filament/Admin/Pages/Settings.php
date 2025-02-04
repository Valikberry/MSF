<?php

namespace App\Filament\Admin\Pages;

use App\Configuration\Admin as AdminConfig;
use App\Enums\Currency;
use Closure;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Settings extends BaseSettings
{

    public function beforeSave(): void
    {
        $form = $this->form->getState();
        if (
            isset($form['company_logo'])
            && ((string) $form['company_logo']) != setting('company_logo')
            && (((string) setting('company_logo'))  > 0)
        ) {
            if (Storage::disk(AdminConfig::getCompanyMediaDisk())->exists(setting('company_logo'))) {
                Storage::disk(AdminConfig::getCompanyMediaDisk())->delete(setting('company_logo'));
            }
        }
    }

    public function schema(): array|Closure
    {
        return [
            Tabs::make('Settings')
                ->schema([
                    Tabs\Tab::make('General')
                        ->schema([
                            TextInput::make('company_name')
                                ->required(),
                            FileUpload::make('company_logo')
                                ->disk(AdminConfig::getCompanyMediaDisk())
                                ->directory(AdminConfig::getCompanyMediaDirectory())
                                ->preserveFilenames()
                                ->previewable()
                                ->openable()
                                ->acceptedFileTypes(AdminConfig::getCompanyMediaTypes())
                                ->minSize(AdminConfig::getCompanyMediaMinSize())
                                ->maxSize(AdminConfig::getCompanyMediaMaxSize())
                                ->getUploadedFileNameForStorageUsing(
                                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                        ->prepend(now()->timestamp.'_'),
                                ),
                            Select::make('currency')
                                ->options(Currency::all())
                                ->required(),
                            TextInput::make('terms_page_link')
                                ->label('Terms and condition page link')
                                ->required(),
                            TextInput::make('consent_page_link')
                                ->label('Consent page link')
                                ->required(),
                            TextInput::make('country_flag')
                                ->required(),
                            TextInput::make('phone_code')
                                ->required(),
                            RichEditor::make('footer_content'),

                            Section::make('Footer Links')
                                ->schema([
                                    Repeater::make('footer_links')
                                        ->label('Links')
                                        ->schema([
                                            TextInput::make('name')->required(),
                                            TextInput::make('link')->required(),
                                        ])
                                        ->columns(2),
                                ])
                                ->collapsed(),

                            Section::make('Social Links')
                                ->schema([
                                    Repeater::make('social_links')
                                        ->label('Links')
                                        ->schema([
                                            TextInput::make('icon')->required(),
                                            TextInput::make('link')->required(),
                                        ])
                                        ->columns(2),
                                ])
                                ->collapsed(),



                        ]),


                    Tabs\Tab::make('SEO')
                        ->schema([
                            TextInput::make('site_author')
                                ->label('Author')
                                ->required(),
                            TextInput::make('meta_title')
                                ->required(),
                            Textarea::make('meta_description')
                                ->required(),
                            Textarea::make('meta_keywords')
                                ->nullable(),
                        ]),


                    Tabs\Tab::make('External Services')
                        ->schema([
                            Placeholder::make('sheet_api_mail')
                                ->label('Sheet API Mail')
                                ->content(config('services.google_sheet.api_mail')),
                            TextInput::make('admin_sheet_id')
                                ->label('Admin Spreadsheet ID')
                                ->required(),
                            TextInput::make('admin_sheet_name')
                                ->label('Admin Spreadsheet Name')
                                ->required(),
                            TextInput::make('sales_sheet_id')
                                ->label('Sales Spreadsheet ID')
                                ->required(),
                            TextInput::make('sales_sheet_name')
                                ->label('Sales Spreadsheet Name')
                                ->required(),

                            TextInput::make('contact_sheet_id')
                                ->label('Contact Form Spreadsheet ID')
                                ->required(),
                            TextInput::make('contact_sheet_name')
                                ->label('Contact Form Spreadsheet Name')
                                ->required(),
                        ]),


                ]),
        ];
    }
}
