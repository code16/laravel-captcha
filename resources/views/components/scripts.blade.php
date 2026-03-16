
@if(config('captcha.enabled'))
    <x-dynamic-component
        :component="'captcha::'.config('captcha.provider').'.scripts'"
        :attributes="$attributes"
    />
@endif
