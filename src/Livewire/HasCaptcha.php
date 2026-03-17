<?php

namespace Code16\Captcha\Livewire;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * @mixin Component
 */
trait HasCaptcha
{
    public function exceptionHasCaptcha($e): void
    {
        if ($e instanceof ValidationException) {
            $this->resetCaptcha();
        }
    }

    public function resetCaptcha(): void
    {
        $this->dispatch('reset-captcha');
    }
}
