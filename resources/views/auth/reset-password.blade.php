<x-guest-layout>
    <h2 class="h3 mb-3 text-center">
        {{ __('Reset Password') }}
    </h2>

    <form method="POST" action="{{ route('password.store') }}" class="form-group flex-wrap">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-input col-lg-12 my-3">
            <label for="email" class="form-label fs-6 text-uppercase fw-bold text-black">
                {{ __('Email Address') }}
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
                autocomplete="username"
                class="form-control ps-3 @error('email') is-invalid @enderror"
                placeholder="{{ __('Email') }}"
            >
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-input col-lg-12 my-3">
            <label for="password" class="form-label fs-6 text-uppercase fw-bold text-black">
                {{ __('New Password') }}
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                class="form-control ps-3 @error('password') is-invalid @enderror"
                placeholder="{{ __('Password') }}"
            >
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-input col-lg-12 my-3">
            <label for="password_confirmation" class="form-label fs-6 text-uppercase fw-bold text-black">
                {{ __('Confirm Password') }}
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="form-control ps-3 @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('Confirm Password') }}"
            >
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid my-3">
            <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none fs-6" type="submit">
                {{ __('Reset Password') }}
            </button>
        </div>

        <p class="text-center mt-3 mb-0">
            <a href="{{ route('login') }}" class="password">
                {{ __('Back to login') }}
            </a>
        </p>
    </form>
</x-guest-layout>
