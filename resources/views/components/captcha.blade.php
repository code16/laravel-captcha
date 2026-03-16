
@if(config('captcha.enabled'))
    <x-dynamic-component
        :component="'captcha::'.config('captcha.provider').'.widget'"
        :attributes="$attributes"
    />
@endif
