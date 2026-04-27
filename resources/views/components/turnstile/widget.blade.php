@props([
    /** @var \Code16\Captcha\Enums\CaptchaLoadMode $loadMode */
    'loadMode'
])

<div x-data="{
        widgetId: null,
        token: null,
        intersecting: false,
        load() {
            if(this.widgetId) {
                turnstile.remove(this.widgetId);
            }
            this.widgetId = turnstile.render(this.$el, {
                sitekey: this.$el.getAttribute('data-sitekey'),
                theme: this.$el.getAttribute('data-theme'),
                callback: (token) => {
                    this.token = token;
                },
                'expired-callback': () => {
                    this.reset();
                },
                'response-field-name': 'captcha',
            })
        },
        reset() {
            turnstile.reset(this.widgetId);
        },
        initCaptcha() {
            const form = this.$el.closest('form');

            if(this.$el.getAttribute('data-load-mode') === 'intersect') {
                new IntersectionObserver((entries, observer) => {
                    this.intersecting = entries[0].isIntersecting;
                    if(entries[0].isIntersecting) {
                        if(this.widgetId)  {
                            this.reset();
                        } else {
                            this.load();
                        }
                    }
                }).observe(form || this.$el);
            } else if(this.$el.getAttribute('data-load-mode') === 'form-interaction') {
                form.addEventListener('focusin', () => !this.widgetId && this.load(), { once:true });
                form.addEventListener('input', () => !this.widgetId && this.load(), { once:true });
                form.addEventListener('change', () => !this.widgetId && this.load(), { once:true });
            } else {
                this.load();
            }

            this.$nextTick(() => {
                new MutationObserver(() => {
                    this.intersecting && this.load();
                }).observe(this.$el, { attributes: true, attributeFilter: ['data-theme'] });
            });

            this.$wire?.on('reset-captcha', () => {
                this.token = null;
            });
            this.$el.addEventListener('reset-captcha', () => {
                this.token = null;
            });

            this.$watch('token', (token) => {
                if(!token && this.widgetId) {
                    this.reset();
                }
            });
        },
        init() {
            if('turnstile' in window) {
                this.initCaptcha();
            } else {
                document.querySelector('#turnstile-script').addEventListener('load', () => this.initCaptcha());
            }
        }
    }"
    data-captcha
    data-sitekey="{{ config('captcha.providers.turnstile.site_key') }}"
    data-load-mode="{{
        config('captcha.providers.turnstile.invisible_mode')
            ? \Code16\Captcha\Enums\CaptchaLoadMode::PageLoad->value
            : $loadMode->value
    }}"
    x-modelable="token"
    wire:ignore
    {{ $attributes->merge(['data-theme' => config('captcha.theme')]) }}
>
</div>
