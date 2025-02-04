<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('frontend.booking.__layout_booking', function (View $view) {
            $sliders = \App\Models\Slider::active()->orderBy('sort_order')->get();
            $step = getBookingStep();
            $isServicePage = false;

            $view->with(compact('sliders', 'step', 'isServicePage'));
        });
    }
}
