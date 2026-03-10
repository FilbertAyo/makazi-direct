<x-guest-layout>
    <h2 class="h3 mb-3 text-center">
        {{ __('Forgot your password?') }}
    </h2>

    <p class="mb-4 text-muted text-center">
        {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
    </p>

    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="form-group flex-wrap">
        @csrf

        <div class="form-input col-lg-12 my-3">
            <label for="email" class="form-label fs-6 text-uppercase fw-bold text-black">
                {{ __('Email Address') }}
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="form-control ps-3 @error('email') is-invalid @enderror"
                placeholder="{{ __('Email') }}"
            >
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid my-3">
            <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none fs-6" type="submit">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>

        <p class="text-center mt-3 mb-0">
            <a href="{{ route('login') }}" class="password">
                {{ __('Back to login') }}
            </a>
        </p>
    </form>
</x-guest-layout>
