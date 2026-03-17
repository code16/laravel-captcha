<?php

namespace Code16\Captcha\Testing;

use Code16\Captcha\Contracts\ClientInterface;
use Illuminate\Support\Testing\Fakes\Fake;

abstract class FakeClient implements ClientInterface, Fake
{
    protected bool $shouldPass = true;

    protected bool $isExpired = false;

    public function fail(): self
    {
        $this->shouldPass = false;

        return $this;
    }

    public function expired(): self
    {
        $this->isExpired = true;

        return $this;
    }

    public function pass(): self
    {
        $this->shouldPass = true;

        return $this;
    }
}
