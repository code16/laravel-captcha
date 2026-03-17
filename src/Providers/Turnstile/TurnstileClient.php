<?php

namespace Code16\Captcha\Providers\Turnstile;

use Code16\Captcha\Contracts\ClientInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Context;
use RyanChandler\LaravelCloudflareTurnstile\Client;
use RyanChandler\LaravelCloudflareTurnstile\Responses\SiteverifyResponse;

class TurnstileClient implements ClientInterface
{
    public function __construct(protected string $secret)
    {
    }

    public function verify(string $token): SiteverifyResponse
    {
        try {
            return new Client($this->secret)->siteverify($token);
        } catch (RequestException $exception) {
            Context::add('response', $exception->response);

            return SiteverifyResponse::failure($exception->response->json('error-codes', ['unknown']));
        }
    }
}
