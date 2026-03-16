<?php

namespace Code16\Captcha\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use RyanChandler\LaravelCloudflareTurnstile\Rules\Turnstile;

class Captcha implements ValidationRule
{
    public bool $implicit = true;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!config('captcha.enabled')) {
            return;
        }

        $validator = Validator::make(
            [$attribute => $value],
            [
                $attribute => [
                    'required',
                    match(config('captcha.provider')) {
                        'turnstile' => new Turnstile(),
                    }
                ]
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->get($attribute) as $message) {
                $fail($message);
            }
        }
    }
}
