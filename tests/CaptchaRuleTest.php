<?php

use Code16\Captcha\Facades\Captcha as CaptchaFacade;
use Code16\Captcha\Rules\Captcha;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

it('passes validation when disabled', function () {
    Config::set('captcha.enabled', false);

    $validator = Validator::make(
        ['captcha' => 'test'],
        ['captcha' => new Captcha()]
    );

    expect($validator->passes())->toBeTrue();
});

describe('turnstile', function () {
    it('fails validation when enabled and empty', function () {
        Config::set('captcha.enabled', true);
        Config::set('captcha.provider', 'turnstile');
        Config::set('captcha.providers.turnstile.secret_key', '1x00000000000000000000AA');

        $validator = Validator::make(
            ['captcha' => ''],
            ['captcha' => new Captcha()]
        );

        expect($validator->fails())->toBeTrue();
    });

    it('passes validation when using fake', function () {
        Config::set('captcha.enabled', true);
        Config::set('captcha.provider', 'turnstile');
        Config::set('captcha.providers.turnstile.secret_key', '1x00000000000000000000AA');

        CaptchaFacade::fake();

        $validator = Validator::make(
            ['captcha' => 'dummy-token'],
            ['captcha' => new Captcha()]
        );

        expect($validator->passes())->toBeTrue();
    });
});
