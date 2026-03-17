<?php

return [
    'enabled' => env('CAPTCHA_ENABLED', true),
    'provider' => env('CAPTCHA_PROVIDER', 'turnstile'),
    'providers' => [
        'turnstile' => [
            'site_key' => env('CAPTCHA_TURNSTILE_SITE_KEY'),
            'secret_key' => env('CAPTCHA_TURNSTILE_SECRET_KEY'),
        ],
    ],
];
