<?php

namespace App\Console\Commands;


use App\Services\Whatsapp\WhatsappMessage;
use Illuminate\Console\Command;


class SendTestWhatsappMessage extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send whatsapp message';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $test = WhatsappMessage::send('9779860357792', 'Hey there good morning');
        dd($test);
    }

}
