<?php

namespace Code16\Captcha\Providers\Turnstile;

use Closure;
use Code16\Captcha\Facades\Captcha;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;
use RyanChandler\LaravelCloudflareTurnstile\Responses\SiteverifyResponse;

class TurnstileRule implements ValidationRule
{
    protected array $messages = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * @var SiteverifyResponse $response
         */
        $response = Captcha::verify($value);

        if ($response->success) {
            return;
        }

        if (count($response->errorCodes)) {
            if (config('captcha.log_verification_errors')) {
                Log::channel(config('captcha.log_channel'))->error('Captcha verification API failed', [
                    'provider' => 'turnstile',
                    'errorCodes' => $response->errorCodes,
                ]);
            }
            $fail(__('captcha::errors.verification_failed'));
        }
    }
}
