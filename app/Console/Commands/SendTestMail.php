<?php

namespace App\Console\Commands;


use App\Mail\BookingConfirmationToCustomer;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class SendTestMail extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send customer message';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $booking = Booking::first();
        Mail::to('crystal.dhana@gmail.com')->send(new BookingConfirmationToCustomer($booking));
    }

}
