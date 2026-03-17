<?php

namespace Code16\Captcha;

use Code16\Captcha\Contracts\ClientInterface;
use Code16\Captcha\View\Components\Captcha;
use Illuminate\Foundation\Application;
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
            ->hasTranslations()
            ->hasViews('captcha');
    }

    public function packageRegistered()
    {
        $this->app->scoped(ClientFactory::class, static fn (Application $app) => new ClientFactory(
            provider: $app['config']->get('captcha.provider'),
            secret: match ($app['config']->get('captcha.provider')) {
                'turnstile' => $app['config']->get('captcha.providers.turnstile.secret_key'),
            },
        ));

        $this->app->scoped(ClientInterface::class, static function (Application $app) {
            return $app[ClientFactory::class]->make();
        });
    }

    public function packageBooted(): void
    {
        Blade::component('captcha', Captcha::class);

        Config::set([
            'services.turnstile.secret' => config('captcha.providers.turnstile.secret_key', ''),
        ]);
    }
}
