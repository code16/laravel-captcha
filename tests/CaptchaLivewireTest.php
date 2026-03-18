<?php

namespace Code16\Captcha\Tests;

use Code16\Captcha\Livewire\HasCaptcha;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Livewire\Livewire;

class ComponentWithHasCaptcha extends Component
{
    use HasCaptcha;

    public function render()
    {
        return '<div><x-captcha /></div>';
    }
}

class ComponentWithoutHasCaptcha extends Component
{
    public function render()
    {
        return '<div><x-captcha /></div>';
    }
}

it('does not throw an exception when rendering the captcha component in a livewire component with HasCaptcha trait', function () {
    Config::set('captcha.enabled', true);
    Config::set('captcha.provider', 'test');

    Livewire::test(ComponentWithHasCaptcha::class)
        ->assertStatus(200);
});

it('throws an exception when rendering the captcha component in a livewire component without HasCaptcha trait', function () {
    Config::set('captcha.enabled', true);
    Config::set('captcha.provider', 'test');

    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('The HasCaptcha trait is missing in the livewire component: ComponentWithoutHasCaptcha');

    Livewire::test(ComponentWithoutHasCaptcha::class);
});
