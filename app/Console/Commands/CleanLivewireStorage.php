<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CleanLivewireStorage extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:livewire_storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean storage folders';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        File::cleanDirectory(storage_path('app/livewire-tmp'));
        $this->info('Livewire temporary storeage cleared');

    }
}
