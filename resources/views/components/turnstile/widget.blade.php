
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
        init() {
            new IntersectionObserver((entries, observer) => {
                this.intersecting = entries[0].isIntersecting;
                if(entries[0].isIntersecting) {
                    if(this.widgetId)  {
                        this.reset();
                    } else {
                        this.load();
                    }
                }
            }).observe(this.$el.closest('form') || this.$el);

            this.$nextTick(() => {
                new MutationObserver(() => {
                    this.intersecting && this.load();
                }).observe(this.$el, { attributes: true, attributeFilter: ['data-theme'] });
            });

            this.$wire?.on('reset-captcha', () => {
                this.token = null;
            });

            this.$watch('token', (token) => {
                if(!token && this.widgetId) {
                    this.reset();
                }
            });
        }
    }"
    data-sitekey="{{ config('captcha.providers.turnstile.site_key') }}"
    x-modelable="token"
    wire:ignore
    {{ $attributes }}
>
</div>
