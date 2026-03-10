<x-guest-layout>
    <h2 class="h3 mb-3 text-center">
        {{ __('Confirm Password') }}
    </h2>

    <p class="mb-4 text-muted text-center">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="form-group flex-wrap">
        @csrf

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
        </div>

        <div class="d-grid my-3">
            <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none fs-6" type="submit">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
