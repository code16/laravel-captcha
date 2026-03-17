<?php

return [
    'enabled' => env('CAPTCHA_ENABLED', true),
    'provider' => env('CAPTCHA_PROVIDER', 'turnstile'),
    'theme' => env('CAPTCHA_THEME', 'light'),
    'providers' => [
        'turnstile' => [
            'site_key' => env('CAPTCHA_TURNSTILE_SITE_KEY', ''),
            'secret_key' => env('CAPTCHA_TURNSTILE_SECRET_KEY', ''),
            'invisible_mode' => env('CAPTCHA_TURNSTILE_INVISIBLE_MODE', false),
        ],
    ],
    'log_channel' => env('CAPTCHA_LOG_CHANNEL'),
    'log_verification_errors' => env('CAPTCHA_LOG_VERIFICATION_ERRORS', true),
];
