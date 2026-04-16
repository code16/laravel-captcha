
@php($nonce = \Illuminate\Support\Facades\Vite::cspNonce())

<script
    id="turnstile-script"
    src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit"
    defer
    {{ $attributes->merge(['nonce' => $nonce]) }}
></script>

<script {{ $attributes->merge(['nonce' => $nonce]) }}>
    document.getElementById('turnstile-script').addEventListener('error', () => console.error('Turnstile script failed to load.'));
</script>
