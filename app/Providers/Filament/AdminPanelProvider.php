<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Auth\Login;
use App\Filament\Admin\Pages\Settings;
use App\Filament\Admin\Widgets\AdminDashboardStats;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Outerweb\FilamentSettings\Filament\Plugins\FilamentSettingsPlugin;

class AdminPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->darkMode(false)
            ->defaultThemeMode(ThemeMode::Light)
            ->id('admin')
            ->path('admin')
            ->brandName(getAppName())
            ->brandLogo(getLogoUrl())
            ->favicon(getFaviconUrl())
            ->login(Login::class)
            ->colors(['primary' => getPrimaryColor()])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('web')
            ->plugins([
                \Statikbe\FilamentTranslationManager\FilamentChainedTranslationManagerPlugin::make(),
                FilamentSettingsPlugin::make()
                    ->pages([
                        Settings::class,
                    ])
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => "<link href='".asset('assets/admin/css/style.css')."' rel='stylesheet'>",
            );
    }

    public static function redirectToLoginUrl()
    {

    }


}
