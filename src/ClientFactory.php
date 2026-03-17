<?php

namespace Code16\Captcha;

use Code16\Captcha\Contracts\ClientInterface;
use Code16\Captcha\Providers\Turnstile\TurnstileClient;
use Code16\Captcha\Providers\Turnstile\TurnstileFakeClient;
use Code16\Captcha\Testing\FakeClient;
use RyanChandler\LaravelCloudflareTurnstile\Facades\Turnstile;

class ClientFactory
{
    public function __construct(
        protected string $provider,
        protected ?string $secret,
    ) {
    }

    public function fake(): FakeClient
    {
        return match ($this->provider) {
            'turnstile' => new TurnstileFakeClient(Turnstile::fake()),
        };
    }

    public function make(): ClientInterface
    {
        return match ($this->provider) {
            'turnstile' => new TurnstileClient($this->secret ?: ''),
        };
    }
}
