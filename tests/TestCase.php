<?php

namespace Code16\Captcha\Tests;

use Code16\Captcha\CaptchaServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            CaptchaServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('app.key', 'base64:u82679z7567L7z88pG3t46089i9V+67TzY977j0866A=');
        config()->set('database.default', 'testing');

        View::addNamespace('captcha', __DIR__.'/views');
    }
}
