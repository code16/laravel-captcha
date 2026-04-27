
@if(config('captcha.enabled'))
    <x-dynamic-component
        :component="'captcha::'.config('captcha.provider').'.widget'"
        :load-mode="$loadMode"
        :attributes="$attributes"
    />
@endif
