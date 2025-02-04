<?php

namespace App\Console\Commands;


use App\Models\City;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCronJob extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test cron job';


    /**
     * Execute the console command.
     */
    public function handle()
    {


        //Log::info('Testing cron job');
    }


}
