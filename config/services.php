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

    'mercadopago' => [
        'mercadopago' => 'https://api.mercadopago.com',
        'key' => env('MP_PUBLIC_KEY'),
        'token' => env('MP_ACCES_TOKEN'),
    ],
    'mercadopago_secundario' => [
        'key' => 'TEST-582575fc-f0e7-4e69-aeeb-78c4b303f9bf',
        'token' => 'TEST-3926055628216617-062614-6f17a8a3be6129d451561b1917f2a5e3-2084225921',
    ],
];
