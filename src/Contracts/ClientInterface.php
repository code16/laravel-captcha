<?php

namespace Code16\Captcha\Contracts;

interface ClientInterface
{
    public function verify(string $token): mixed;
}
