<x-guest-layout>
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <h2 class="h3 mb-4 text-center">{{ __('Log In') }}</h2>

    <form method="POST" action="{{ route('login') }}" class="form-group flex-wrap">
        @csrf

        <div class="form-input col-lg-12 my-3">
            <label for="login" class="form-label fs-6 text-uppercase fw-bold text-black">
                {{ __('Phone or Email') }}
            </label>
            <input
                id="login"
                type="text"
                name="login"
                value="{{ old('login') }}"
                required
                autofocus
                autocomplete="username"
                class="form-control ps-3 @error('login') is-invalid @enderror"
                placeholder="{{ __('+255712345678 or email@example.com') }}"
            >
            @error('login')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-input col-lg-12 my-3">
            <label for="password" class="form-label fs-6 text-uppercase fw-bold text-black">
                {{ __('Password') }}
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="form-control ps-3 @error('password') is-invalid @enderror"
                placeholder="{{ __('Password') }}"
            >
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            @if (Route::has('password.request'))
                <div class="form-text text-center mt-2">
                    <a href="{{ route('password.request') }}" class="password">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </div>

        <label class="py-2 d-flex align-items-center">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="d-inline me-2"
            >
            <span class="label-body text-black">
                {{ __('Remember Me') }}
            </span>
        </label>

        <div class="d-grid my-3">
            <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none fs-6" type="submit">
                {{ __('Log In') }}
            </button>
        </div>

        <p class="text-center mt-3 mb-0">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="password">
                {{ __('Sign Up') }}
            </a>
        </p>
    </form>
</x-guest-layout>
