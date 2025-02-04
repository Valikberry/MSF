<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CleanStorageFolders extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:app_storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean storage folders';


    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        File::cleanDirectory(storage_path('app/public/services'));
        $this->info('Service storage cleared');

        File::cleanDirectory(storage_path('app/public/companies'));
        $this->info('Company storage cleared');

        File::cleanDirectory(storage_path('app/public/branches'));
        $this->info('Branch storage cleared');

        File::cleanDirectory(storage_path('app/public/settings'));
        $this->info('Settings storage cleared');

        File::cleanDirectory(storage_path('app/public/banners'));
        $this->info('Banner storage cleared');

        File::cleanDirectory(base_path('lang-custom'));
        $this->info('Custom Language folder cleared');
    }
}
