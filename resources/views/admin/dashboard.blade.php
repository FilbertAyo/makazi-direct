<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin.users.index') }}" class="card h-100 text-decoration-none text-dark shadow-none">
                        <div class="card-body">
                            <div class="text-muted small text-uppercase fw-medium">{{ __('All Users') }}</div>
                            <div class="fs-4 fw-semibold">{{ $userCounts['all'] ?? 0 }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="card h-100 text-decoration-none text-dark shadow-none">
                        <div class="card-body">
                            <div class="text-muted small text-uppercase fw-medium">{{ __('Admins') }}</div>
                            <div class="fs-4 fw-semibold">{{ $userCounts['admin'] ?? 0 }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin.users.index', ['role' => 'tenant']) }}" class="card h-100 text-decoration-none text-dark shadow-none">
                        <div class="card-body">
                            <div class="text-muted small text-uppercase fw-medium">{{ __('Tenants') }}</div>
                            <div class="fs-4 fw-semibold">{{ $userCounts['tenant'] ?? 0 }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin.users.index', ['role' => 'landlord']) }}" class="card h-100 text-decoration-none text-dark shadow-none">
                        <div class="card-body">
                            <div class="text-muted small text-uppercase fw-medium">{{ __('Landlords') }}</div>
                            <div class="fs-4 fw-semibold">{{ $userCounts['landlord'] ?? 0 }}</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="card shadow-none">
                <div class="card-body">
                    <p class="mb-3">{{ __("You're logged in as an administrator.") }}</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('admin.users.index') }}" class="text-decoration-none fw-medium text-primary">
                            {{ __('View all users') }}
                        </a>
                        <a href="{{ route('admin.landlords.pending') }}" class="text-decoration-none fw-medium text-primary">
                            {{ __('Review pending landlord applications') }}
                            @if (($pendingLandlords ?? 0) > 0)
                                <span class="badge bg-warning text-dark">{{ $pendingLandlords }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
