<?php

namespace Code16\Captcha\View\Components;

use Code16\Captcha\Livewire\HasCaptcha;
use Exception;
use Illuminate\View\Component;
use Livewire\Livewire;

class Captcha extends Component
{
    public function __construct()
    {
        $this->checkLivewireComponent();
    }

    protected function checkLivewireComponent(): void
    {
        if (!class_exists(Livewire::class)) {
            return;
        }

        $component = Livewire::current();

        if ($component && !in_array(HasCaptcha::class, class_uses_recursive($component))) {
            throw new Exception(
                sprintf('The HasCaptcha trait is missing in the livewire component: %s', class_basename($component))
            );
        }
    }

    public function render()
    {
        return view('captcha::components.captcha');
    }
}
