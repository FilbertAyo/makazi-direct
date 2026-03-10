<x-guest-layout>
    <div class="text-center py-4">
        @if (session('status'))
            <div class="alert alert-info mb-4" role="alert">{{ session('status') }}</div>
        @endif
        <span class="fs-1 d-block mb-3">⏳</span>
        <h2 class="h3 mb-3">{{ __('Account Pending Approval') }}</h2>
        <p class="text-muted mb-4">
            {{ __('Thank you for registering as a landlord. We are reviewing your documents and will activate your account soon. You will be able to log in once approved.') }}
        </p>
        @auth
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-secondary me-2">{{ __('Log Out') }}</button>
            </form>
        @endauth
        <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ __('Back to Login') }}</a>
    </div>
</x-guest-layout>
