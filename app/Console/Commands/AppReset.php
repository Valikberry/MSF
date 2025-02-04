<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AppReset extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run app reset command';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('clean:app_storage');
        $this->info('Application storage cleaned successfully');

        Artisan::call('migrate:fresh');
        $this->info('Database migrated successfully');

        Artisan::call('db:seed');
        $this->info('Database seeded successfully');

        Artisan::call('clean:livewire_storage');
        $this->info('Livewire temporary storage cleaned successfully');

        Artisan::call('debugbar:clear');
        $this->info('Debugbar storage cleaned successfully');

        Artisan::call('view:clear');
        $this->info('App view cleaned successfully');

        Artisan::call('cache:clear');
        $this->info('App cache cleaned successfully');
    }
}
