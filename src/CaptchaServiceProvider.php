<?php

namespace Code16\Captcha;

use Code16\Captcha\View\Components\Captcha;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CaptchaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-captcha')
            ->hasConfigFile()
            ->hasViews('captcha');
    }

    public function packageBooted()
    {
        Blade::component('captcha', Captcha::class);
        Config::set([
            'services.turnstile.key' => config('captcha.providers.turnstile.site_key'),
            'services.turnstile.secret' => config('captcha.providers.turnstile.secret_key'),
        ]);
    }
}
