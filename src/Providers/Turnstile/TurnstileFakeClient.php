<?php

namespace Code16\Captcha\Providers\Turnstile;

use Code16\Captcha\Testing\FakeClient;
use RyanChandler\LaravelCloudflareTurnstile\Responses\SiteverifyResponse;

class TurnstileFakeClient extends FakeClient
{
    public function __construct(
        protected \RyanChandler\LaravelCloudflareTurnstile\Testing\FakeClient $client
    ) {
    }

    public function expired(): self
    {
        $this->client->expired();

        return parent::expired();
    }

    public function pass(): self
    {
        $this->client->pass();

        return parent::pass();
    }

    public function fail(): self
    {
        $this->client->fail();

        return parent::fail();
    }

    public function verify(string $token): SiteverifyResponse
    {
        return $this->client->siteverify($token);
    }
}
