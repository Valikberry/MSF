<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'whatsapp' => [
        'enable'    => env('WHATSAPP_ENABLE', false),
        'sender_no' => env('WHATSAPP_SENDER_NO', '9818560614'),
        'sender_id' => env('WHATSAPP_SENDER_ID', '415341411657558'),
        'access_token' => env('WHATSAPP_ACCESS_TOKEN', 'EAAOhT4abAdwBO0mMeYppCMZBKWDS90OQEseSejQUZCAxUzveaYgU1JWwqRNm6XRFamOrVce0I035IKT1APO2jaSJZAPJhkWjTUUyK7rFiIYnqEJGtKY75m1U5GQbTpn48f1oHeEZCwlX94U4LqwAMVZBx67PAxqW5HLwBRNvPO0HZA2dCbXqoR2w64zJ94Ccx93CRhQGQrzanttgDjLBKaOlmnwZAUmEYYZD'),
    ],

    'google_sheet' => [
        'api_mail' => env('GOOGLE_SHEET_API_MAIL', 'moving-service-finland@moving-service-finland.iam.gserviceaccount.com'),
        'admin_sheet_id' => env('ADMIN_GOOGLE_SHEET_ID', '1q0HBrRJknPubRCmumrxCqorf7Npj_AxMu7xKlKoQ5JQ'),
        'sales_sheet_id' => env('SALES_GOOGLE_SHEET_ID', '1UKafBazpxlRt69f2ZQ03ll03UyWTmUICOHluLd_1xfw'),
        'contact_sheet_id' => env('CONTACT_GOOGLE_SHEET_ID', '1R55KDr_Dwg3Nmi5Wvm5mJRu5Ceg6cgO3eMK8CLB8I_0'),
    ]

];
