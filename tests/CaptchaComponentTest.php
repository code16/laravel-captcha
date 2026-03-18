<?php

namespace Code16\Captcha\Tests;

use Illuminate\Support\Facades\Config;

it('renders the captcha component with turnstile provider', function () {
    Config::set('captcha.enabled', true);
    Config::set('captcha.provider', 'turnstile');
    Config::set('captcha.providers.turnstile.site_key', 'test-site-key');

    $view = $this->blade('<x-captcha />');

    $view->assertSee('data-sitekey="test-site-key"', false);
});

it('does not render the captcha component when disabled', function () {
    Config::set('captcha.enabled', false);

    $view = $this->blade('<x-captcha />');

    $view->assertDontSeeHtml('<div');
});
