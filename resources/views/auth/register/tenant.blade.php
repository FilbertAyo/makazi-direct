<x-guest-layout>
    <div class="mb-3">
        <div class="d-flex justify-content-between small text-muted mb-1">
            <span>{{ __('Step 2 of 2') }}</span>
            <span>{{ __('Tenant') }}</span>
        </div>
        <div class="progress" style="height: 6px;">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <h2 class="h3 mb-4 text-center">{{ __('Your Details') }}</h2>

    <form method="POST" action="{{ route('register.tenant.store') }}" class="form-group flex-wrap">
        @csrf

        <div class="form-input col-lg-12 my-3">
            <label for="name" class="form-label fs-6 text-uppercase fw-bold text-black">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   autocomplete="name" class="form-control ps-3 @error('name') is-invalid @enderror"
                   placeholder="{{ __('Full Name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-input col-lg-12 my-3">
            <label for="phone_digits" class="form-label fs-6 text-uppercase fw-bold text-black">{{ __('Phone Number') }}</label>
            <x-phone-input-tz name="phone" :old-phone="old('phone')" :required="true" />
        </div>

        <div class="form-input col-lg-12 my-3">
            <label for="email" class="form-label fs-6 text-uppercase fw-bold text-black">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   autocomplete="email" class="form-control ps-3 @error('email') is-invalid @enderror"
                   placeholder="{{ __('Email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-input col-lg-12 my-3">
            <label for="password" class="form-label fs-6 text-uppercase fw-bold text-black">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="form-control ps-3 @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-input col-lg-12 my-3">
            <label for="password_confirmation" class="form-label fs-6 text-uppercase fw-bold text-black">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   autocomplete="new-password" class="form-control ps-3" placeholder="{{ __('Confirm Password') }}">
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('register') }}" class="btn btn-outline-secondary">{{ __('Back') }}</a>
            <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none fs-6" type="submit">
                {{ __('Sign Up') }}
            </button>
        </div>
    </form>
</x-guest-layout>
