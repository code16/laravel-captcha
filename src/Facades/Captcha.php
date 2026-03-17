<?php

namespace Code16\Captcha\Facades;

use Code16\Captcha\ClientFactory;
use Code16\Captcha\Contracts\ClientInterface;
use Code16\Captcha\Testing\FakeClient;
use Illuminate\Support\Facades\Facade;

class Captcha extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ClientInterface::class;
    }

    public static function fake(): FakeClient
    {
        static::swap($fake = app(ClientFactory::class)->fake());

        return $fake;
    }
}
