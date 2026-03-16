<?php

namespace Code16\Captcha\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use RyanChandler\LaravelCloudflareTurnstile\Rules\Turnstile;

class Captcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(config('captcha.provider') === 'turnstile') {
            new Turnstile()->validate($attribute, $value, $fail);
        } else {
            throw new \Exception('Captcha provider not found');
        }
    }
}
