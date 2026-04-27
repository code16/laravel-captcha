<?php

namespace Code16\Captcha\Enums;

enum CaptchaLoadMode: string
{
    case FormInteraction = 'form-interaction';
    case Intersect = 'intersect';
    case PageLoad = 'page-load';
}
