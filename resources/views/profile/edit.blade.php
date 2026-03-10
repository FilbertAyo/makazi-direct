@extends('layouts.clients.app')

@section('title', 'Profile')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="h2 text-capitalize mb-0">Profile</h1>
        <p class="text-muted mb-0 small">Manage your account settings</p>
    </div>

    {{-- Profile Information --}}
    <section class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h2 class="h5 text-capitalize mb-0">{{ __('Profile Information') }}</h2>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </section>

    {{-- Update Password --}}
    <section class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h2 class="h5 text-capitalize mb-0">{{ __('Update Password') }}</h2>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </section>

    {{-- Delete Account --}}
    <section class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h2 class="h5 text-capitalize mb-0">{{ __('Delete Account') }}</h2>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </section>
@endsection
