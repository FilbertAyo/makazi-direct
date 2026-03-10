<p class="text-muted small mb-4">{{ __("Update your account's profile information and email address.") }}</p>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-muted small mb-1">{{ __('Your email address is unverified.') }}</p>
                <button form="send-verification" type="submit" class="btn btn-link btn-sm p-0 text-decoration-none">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </div>
            @if (session('status') === 'verification-link-sent')
                <p class="mt-2 small text-success">{{ __('A new verification link has been sent to your email address.') }}</p>
            @endif
        @endif
    </div>

    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        @if (session('status') === 'profile-updated')
            <span class="small text-success">{{ __('Saved.') }}</span>
        @endif
    </div>
</form>
