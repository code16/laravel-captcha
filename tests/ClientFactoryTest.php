<?php

use Code16\Captcha\ClientFactory;
use Code16\Captcha\Providers\Turnstile\TurnstileClient;
use Code16\Captcha\Providers\Turnstile\TurnstileFakeClient;

describe('turnstile', function () {
    it('creates client', function () {
        $factory = new ClientFactory('turnstile', 'secret');
        $client = $factory->make();

        expect($client)->toBeInstanceOf(TurnstileClient::class);
    });

    it('creates fake client', function () {
        $factory = new ClientFactory('turnstile', 'secret');
        $client = $factory->fake();

        expect($client)->toBeInstanceOf(TurnstileFakeClient::class);
    });
});
