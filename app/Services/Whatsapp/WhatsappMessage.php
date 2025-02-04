<?php

namespace App\Services\Whatsapp;

use Illuminate\Support\Facades\Http;

class WhatsappMessage
{
    public static function getApiUrl(): string
    {
        return 'https://graph.facebook.com/v20.0/'.config('services.whatsapp.sender_id').'/messages';
    }

    public static function send(string $to, string $message) {

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.config('services.whatsapp.access_token'),
            ])
                ->post(self::getApiUrl(), [
                    "messaging_product" => "whatsapp",
                    'recipient_type' => 'individual',
                    "to" => $to,
                    'text' => [
                        "preview_url" => false,
                        'body' => $message
                    ],
                ]);

            return json_decode($response->body());

        } catch (\Exception $exception) {
            return false;
        }



        /*"type" => "template",
                "template" => [
                    "name" => "hello_world",
                    "language" => [
                        "code" => "en_US"
                    ]
                ]


                    "messaging_product" => "whatsapp",
                    'recipient_type' => 'individual',
                    "to" => $to,
                    'text' => [
                        "preview_url" => false,
                        'body' => $message
                    ],


        "type" => "template",
                    "template" => [
                        "name" => "hello_world", // Your approved template name
                        "language" => ["code" => "en_US"], // Language code
                        "components" => [
                            [
                                "type" => "header",
                                "parameters" => [
                                    [
                                        "type" => "IMAGE",
                                        "image" => [
                                            "link" => 'https://mover.dhankumarlama.com.np/storage/company/logo.png' // URL of the image
                                        ]
                                    ]
                                ]
                            ],
                            [
                                "type" => "body",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => $message // Replace with dynamic text
                                    ],
                                ]
                            ],
                            [
                                "type" => "button",
                                "sub_type" => "url",
                                "index" => "0",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => 'http://loc_moverservice' // Link URL
                                    ]
                                ]
                            ]
                        ]
                    ]

        */

    }

}
