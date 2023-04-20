<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The default SMS Driver
    |--------------------------------------------------------------------------
    | 
    | The default sms driver to use as a fallback when no driver is specified
    | while using the SMS component.
    |
    */
    // 'default' => env('SMS_DRIVER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Nexmo Driver Configuration
    |--------------------------------------------------------------------------
    |
    | We specify key, secret, and the number messages will be sent from.
    |
    */
    'nexmo' => [
        'key' => env('NEXMO_KEY', ''),
        'secret' => env('NEXMO_SECRET', ''),
        'from' => env('NEXMO_SMS_FROM', '')
    ],

    /*
    |--------------------------------------------------------------------------
    | Twilio Driver Configuration
    |--------------------------------------------------------------------------
    |
    | We specify key, secret, and the number messages will be sent from.
    |
    */
    'twilio' => [
        'key' => env('TWILIO_KEY', ''),
        'secret' => env('TWILIO_SECRET', ''),
        'from' => env('TWILIO_SMS_FROM', '')
    ],

    /*
    |--------------------------------------------------------------------------
    | Twilio Driver Configuration
    |--------------------------------------------------------------------------
    |
    | We specify key, secret, and the number messages will be sent from.
    |
    */
    'tilism' => [
        'key' => env('TILISM_KEY', ''),
        'secret' => env('TILISM_SECRET', ''),
        'from' => env('TILISM_SMS_FROM', '')
    ],

    'null' => [
        'key' => env('TILISM_KEY', ''),
    ],

];
