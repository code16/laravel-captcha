<?php

namespace Code16\Captcha\Providers\Turnstile;

use Code16\Captcha\Contracts\ClientInterface;
use RyanChandler\LaravelCloudflareTurnstile\Client;
use RyanChandler\LaravelCloudflareTurnstile\Responses\SiteverifyResponse;

class TurnstileClient implements ClientInterface
{
    public function __construct(protected string $secret)
    {
    }

    public function verify(string $token): SiteverifyResponse
    {
        return new Client($this->secret)->siteverify($token);
    }
}
