<?php

namespace Code16\Captcha\View\Components;

use Illuminate\View\Component;

class Captcha extends Component
{
    public function render()
    {
        return view('captcha::components.captcha');
    }
}
