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
    
    'google' => [
        'client_id' => '295320427581-4n9tsrrtpacor5q3p052ifrchr3qbr5q.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/callback/google',
        'options' => ['curl' => [CURLOPT_SSL_VERIFYPEER => false]],
      ], 

    'facebook' => [
        'client_id' => '2209156469286012',
        'client_secret' => '37c40e6f2a49523a8602cdad535ebdb0',
        'redirect' => 'https://127.0.0.1:8000/callback/facebook',
    ], 

    'linkedin' => [
        'client_id' => '78gyk4misv22l1',
        'client_secret' => 'GThWS4xWHXarBRBp',
        'redirect' => 'http://127.0.0.1:8000/callback/linkedin',
    ], 

    'github' => [
        'client_id' => '076522959cdb1d3e0511',
        'client_secret' => 'c6bc546b7c70d4a300e719580c0a3b9162d5f73b',
        'redirect' => 'http://127.0.0.1:8000/callback/github',
    ],

    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
    ],

];
