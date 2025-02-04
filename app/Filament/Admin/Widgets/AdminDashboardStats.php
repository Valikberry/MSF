<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\City;
use App\Models\Company;
use App\Models\Slider;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminDashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Bookings', Booking::count()),
            Stat::make('Total Sliders', Slider::count()),
            Stat::make('Total Cities', City::count()),
            Stat::make('Total Company', Company::count()),
            Stat::make('Total Branches', Branch::count()),
        ];
    }
}
