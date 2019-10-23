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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'github' => [
        'client_id' => env('GITHUB_KEY'),
        'client_secret' => env('GITHUB_SECRET'),
        'redirect' => env('GITHUB_CALLBACK_URL'),
    ],

    'google' => [
        'client_id' => '1054174692349-8ell510lhngslk9tfbsmmamhvshn73tu.apps.googleusercontent.com',
        'client_secret' => 'nPA0Z9s78UzCRVgHRBRusQIl',
        'redirect' => 'http://localhost:8000/social-media/registered/google',
    ],

    'facebook' => [
        'client_id' => '392435735008627',
        'client_secret' => '54e5bf64e5a8a6c583a8c9b51287fb39',
        'redirect' => 'http://localhost:8000/social-media/registered/facebook',
    ],

    'bitbucket' => [
        'client_id' => env('BITBUCKET_KEY'),
        'client_secret' => env('BITBUCKET_SECRET'),
        'redirect' => env('BITBUCKET_CALLBACK_URL'),
    ],

    'linkedin' => [
        'client_id' => env('LINKEDIN_KEY'),
        'client_secret' => env('LINKEDIN_SECRET'),
        'redirect' => env('LINKEDIN_CALLBACK_URL'),
    ],

];
