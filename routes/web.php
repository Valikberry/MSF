<?php

use App\Http\Controllers\FrontendBookingController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/* 
Route::get('/mail', function () {
    $booking = \App\Models\Booking::first();
    if ($booking) {
        return new \App\Mail\BookingConfirmationToCustomer($booking);
    }
    return 'No booking found';
});
Route::get('/clear', function () {
    \App\Libraries\Booking\BookingSession::removeSession();
}); 
*/

Route::get('/booking-process', [FrontendBookingController::class, 'bookingProcess'])->name('booking.process');
Route::get('/booking/{id}', [FrontendBookingController::class, 'viewBooking'])->name('booking.view');
Route::get('/{city?}', [FrontendBookingController::class, 'homePage'])->name('booking.home');
Route::get('/{city}/{company}', [FrontendBookingController::class, 'servicePage'])->name('booking.service');



