<x-guest-layout>
    <div class="mb-3">
        <div class="d-flex justify-content-between small text-muted mb-1">
            <span>{{ __('Step 1') }}</span>
            <span>{{ __('Account Type') }}</span>
        </div>
        <div class="progress" style="height: 6px;">
            <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <h2 class="h3 mb-4 text-center">{{ __('Create Account') }}</h2>

    <p class="text-center text-muted mb-4">{{ __('Choose your account type') }}</p>

    <div class="row g-3">
        <div class="col-12 col-md-6">
            <form method="POST" action="{{ route('register.role.store') }}" class="h-100">
                @csrf
                <input type="hidden" name="role" value="tenant">
                <button type="submit" class="btn btn-outline-primary btn-lg w-100 py-4 d-flex flex-column align-items-center">
                    <span class="fs-2 mb-2">🏠</span>
                    <span class="fw-bold">{{ __('I am a Tenant') }}</span>
                    <span class="small text-dark mt-1">{{ __('Looking for a place to rent') }}</span>
                </button>
            </form>
        </div>
        <div class="col-12 col-md-6">
            <form method="POST" action="{{ route('register.role.store') }}" class="h-100">
                @csrf
                <input type="hidden" name="role" value="landlord">
                <button type="submit" class="btn btn-outline-primary btn-lg w-100 py-4 d-flex flex-column align-items-center">
                    <span class="fs-2 mb-2">🔑</span>
                    <span class="fw-bold">{{ __('I am a Landlord') }}</span>
                    <span class="small text-dark mt-1">{{ __('I want to list my property') }}</span>
                </button>
            </form>
        </div>
    </div>

    <p class="text-center mt-4 mb-0">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="password">{{ __('Log In') }}</a>
    </p>
</x-guest-layout>
