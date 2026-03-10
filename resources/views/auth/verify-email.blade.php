<x-guest-layout>
    <h2 class="h3 mb-3 text-center">
        {{ __('Verify Your Email Address') }}
    </h2>

    <p class="mb-3 text-muted text-center">
        {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just sent you.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4" role="alert">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mt-4 gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="btn btn-primary btn-lg text-uppercase btn-rounded-none fs-6">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-link text-decoration-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
