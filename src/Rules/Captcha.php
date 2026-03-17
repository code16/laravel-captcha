<?php

namespace Code16\Captcha\Rules;

use Closure;
use Code16\Captcha\Providers\Turnstile\TurnstileRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class Captcha implements ValidationRule
{
    public bool $implicit = true;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!config('captcha.enabled')) {
            return;
        }

        $validator = Validator::make(
            [$attribute => $value],
            [
                $attribute => [
                    'required',
                    match (config('captcha.provider')) {
                        'turnstile' => new TurnstileRule(),
                    },
                ],
            ],
            [
                "$attribute.required" => config('captcha.provider') === 'turnstile' && config('captcha.providers.turnstile.invisible_mode')
                    ? __('captcha::errors.required.invisible')
                    : __('captcha::errors.required'),
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->get($attribute) as $message) {
                $fail($message);
            }
        }
    }
}
