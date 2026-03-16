<?php

namespace Code16\Captcha\Livewire;

use Illuminate\Validation\Validator;
use Livewire\Component;

/**
 * @mixin Component
 */
trait HasCaptcha
{
    public function bootHasCaptcha(): void
    {
        $this->withValidator(function (Validator $validator) {
            $validator->after(function (Validator $validator) {
                if ($validator->errors()->count() > 0) {
                    $this->resetCaptcha();
                }
            });
        });
    }

    protected function resetCaptcha(): void
    {
        $this->dispatch('reset-captcha');
    }
}
