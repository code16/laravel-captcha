<?php

namespace Code16\Captcha\Livewire;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * @mixin Component
 */
trait HasCaptcha
{
    protected bool $captchaResetDispatched = false;

    public function bootHasCaptcha(): void
    {
        $this->withValidator(function () {
            $this->resetCaptcha();
        });
    }

    public function exceptionHasCaptcha($e): void
    {
        if ($e instanceof ValidationException) {
            $this->resetCaptcha();
        }
    }

    public function resetCaptcha(): void
    {
        if (!$this->captchaResetDispatched) {
            $this->dispatch('reset-captcha');
            $this->captchaResetDispatched = true;
        }
    }
}
