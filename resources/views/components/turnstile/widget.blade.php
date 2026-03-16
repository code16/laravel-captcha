
<div x-data="{
        widgetId: null,
        token: null,
        load() {
            this.widgetId = turnstile.render(this.$el, {
                sitekey: this.$el.getAttribute('data-sitekey'),
                theme: 'auto',
                callback: (token) => {
                    this.token = token;
                },
                'expired-callback': () => {
                    turnstile.reset(this.widgetId);
                }
            })
        },
        init() {
            new IntersectionObserver((entries, observer) => {
                if(entries[0].isIntersecting) {
                    if(this.widgetId)  {
                        turnstile.reset(this.widgetId);
                    } else {
                        this.load();
                    }
                }
            }).observe(this.$el.closest('form') || this.$el);

            this.$wire?.on('reset-captcha', () => {
                turnstile.reset(this.widgetId);
            });
        }
    }"
    data-sitekey="{{ config('captcha.providers.turnstile.site_key') }}"
    x-modelable="token"
    wire:ignore
    {{ $attributes }}
>
</div>
