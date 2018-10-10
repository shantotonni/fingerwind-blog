<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '51236885692-lrefj7gfqma2t958tk9k3pr6s6i224pi.apps.googleusercontent.com',   //google client key
        'client_secret' => 'sGHGLNRiunOOC50_bYW1AN5Z', //google client secret key
        'redirect' => 'http://fingerwind.nilsagor.com/google/callback',
    ],

    'twitter' => [
        'client_id' => 'pcRUnvFluvBmOvlXAWqVSz3cb',   //twitter client key
        'client_secret' => 'aUcpjSjcg8LzS1qsRwgenpiCAXfxMUhaydDlMzKRQPCXT39YR3', //twitter client secret key
        'redirect' => 'http://fingerwind.nilsagor.com/auth/twitter/callback',
    ],

  'linkedin' => [
        'client_id' => '81thkfm9ehszg8',   //twitter client key
        'client_secret' => 'ttkoIjfVkwSJkmyj', //twitter client secret key
        'redirect' => 'http://fingerwind.nilsagor.com/auth/linkedin/callback',
    ],

];
