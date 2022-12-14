<?php

use App\Models\User;

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

    'slack' => [
        'client_id' => env('SLACK_CLIENT_ID', null),
        'secret' => env('SLACK_SECRET', null),
        'signing_secret' => env('SLACK_SIGNING_SECRET', null),
        'verification' => env('SLACK_VERIFICATION', null),
        'redirect_url' => env('SLACK_REDIRECT_URL', null)
    ],

    'discord' => [
        'client_id' => env('DISCORD_CLIENT_ID', null),
        'secret' => env('DISCORD_SECRET', null),
        'redirect_url' => env('DISCORD_REDIRECT_URL', null),
        'permission_id' => env('DISCORD_PERMISSION_ID', null),
        'bot_token' => env('DISCORD_BOT_TOKEN', null),
    ],

    'stripe' => [
        'model' => User::class,
        'key' => env('STRIPE_KEY', null),
        'secret' => env('STRIPE_SECRET', null),
    ]

];
