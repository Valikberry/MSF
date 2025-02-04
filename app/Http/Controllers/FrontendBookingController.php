<?php

namespace App\Http\Controllers;

use App\Enums\BookingStep;
use App\Models\Branch;
use App\Models\City;
use Illuminate\Http\Request;

class FrontendBookingController extends Controller
{

    public function homePage(string $city = ''): mixed
    {
        if (strlen($city) > 0) {
            City::where('slug', $city)->firstOrFail();
        }

        return view('frontend.booking.home');
    }

    public function servicePage(string $city, string $company): mixed
    {
        $branch = Branch::select('*', 'companies.id as company_id', 'companies.name as company_name', 'branches.id as id')
            ->join('companies', 'branches.company_id', 'companies.id')
            ->join('cities', 'branches.city_id', 'cities.id')
            ->with('services')
            ->where('cities.slug', $city)
            ->where('companies.slug', $company)
            ->first();

        if (!$branch) {
            abort(404);
        }

        $isServicePage = true;

        return view('frontend.booking.service', compact('isServicePage', 'branch'));
    }

    public function bookingProcess(): mixed
    {
        if (getBookingStep() < BookingStep::city->value) {
            return redirect()->route('booking.home');
        }

        if (getBookingStep() == BookingStep::service->value) {
            return redirect()->route('booking.service');
        }


        return view('frontend.booking.process');
    }

    public function viewBooking(string $id): mixed
    {
        $booking = \App\Models\Booking::where('uid', $id)->first();

        if (!$booking) {
            abort(404);
        }
        return view('frontend.booking.confirmed-booking', compact('booking'));
    }


}
