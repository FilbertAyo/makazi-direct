@php($breadcrumbTitle = __('Dashboard'))

<x-app-layout>
    <x-slot name="header">
        <div>
            <h5 class="m-b-10">{{ __('Admin Dashboard') }}</h5>
            <p class="mb-0 text-muted">{{ __('Professional admin overview for users, landlords, and properties.') }}</p>
        </div>
    </x-slot>

    <div class="row g-3">
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('admin.users.index') }}" class="card shadow-none border text-decoration-none h-100">
                <div class="card-body position-relative">
                    <h6 class="mb-2 f-w-400 text-muted">{{ __('All Users') }}</h6>
                    <h4 class="mb-3">{{ $userCounts['all'] ?? 0 }}</h4>
                    <p class="mb-0 text-muted text-sm">{{ __('Platform accounts total') }}</p>
                    <div class="position-absolute end-0 top-0 p-3 text-primary"><i class="ti ti-users f-20"></i></div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="card shadow-none border text-decoration-none h-100">
                <div class="card-body position-relative">
                    <h6 class="mb-2 f-w-400 text-muted">{{ __('Admins') }}</h6>
                    <h4 class="mb-3">{{ $userCounts['admin'] ?? 0 }}</h4>
                    <p class="mb-0 text-muted text-sm">{{ __('System administrators') }}</p>
                    <div class="position-absolute end-0 top-0 p-3 text-success"><i class="ti ti-user-cog f-20"></i></div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('admin.users.index', ['role' => 'tenant']) }}" class="card shadow-none border text-decoration-none h-100">
                <div class="card-body position-relative">
                    <h6 class="mb-2 f-w-400 text-muted">{{ __('Tenants') }}</h6>
                    <h4 class="mb-3">{{ $userCounts['tenant'] ?? 0 }}</h4>
                    <p class="mb-0 text-muted text-sm">{{ __('Registered renters') }}</p>
                    <div class="position-absolute end-0 top-0 p-3 text-warning"><i class="ti ti-user f-20"></i></div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('admin.users.index', ['role' => 'landlord']) }}" class="card shadow-none border text-decoration-none h-100">
                <div class="card-body position-relative">
                    <h6 class="mb-2 f-w-400 text-muted">{{ __('Landlords') }}</h6>
                    <h4 class="mb-3">{{ $userCounts['landlord'] ?? 0 }}</h4>
                    <p class="mb-0 text-muted text-sm">{{ __('Property owners') }}</p>
                    <div class="position-absolute end-0 top-0 p-3 text-danger"><i class="ti ti-home f-20"></i></div>
                </div>
            </a>
        </div>

        <div class="col-md-12 col-xl-4">
            <div class="card shadow-none border h-100">
                <div class="card-body position-relative">
                    <h6 class="mb-2 f-w-400 text-muted">{{ __('Pending Landlord Applications') }}</h6>
                    <h3 class="mb-3">{{ $pendingLandlords ?? 0 }}</h3>
                    <p class="mb-3 text-muted text-sm">{{ __('Landlords waiting for approval decision.') }}</p>
                    <a href="{{ route('admin.landlords.pending') }}" class="btn btn-sm btn-light-warning border border-warning text-warning">
                        {{ __('Open Applications') }}
                    </a>
                    <div class="position-absolute end-0 top-0 p-3 text-warning"><i class="ti ti-hourglass f-20"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-4">
            <div class="card shadow-none border h-100">
                <div class="card-body position-relative">
                    <h6 class="mb-2 f-w-400 text-muted">{{ __('Property Moderation Queue') }}</h6>
                    <h3 class="mb-3">{{ $pendingProperties ?? 0 }}</h3>
                    <p class="mb-3 text-muted text-sm">{{ __('Listings awaiting verification.') }}</p>
                    <a href="{{ route('admin.properties.moderation') }}" class="btn btn-sm btn-light-primary border border-primary text-primary">
                        {{ __('Moderate Properties') }}
                    </a>
                    <div class="position-absolute end-0 top-0 p-3 text-primary"><i class="ti ti-shield-check f-20"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-4">
            <div class="card shadow-none border h-100">
                <div class="card-body position-relative">
                    <h6 class="mb-2 f-w-400 text-muted">{{ __('Verified Properties') }}</h6>
                    <h3 class="mb-3">{{ $verifiedProperties ?? 0 }}</h3>
                    <p class="mb-3 text-muted text-sm">{{ __('Approved listings currently visible.') }}</p>
                    <a href="{{ route('admin.properties.index', ['verification' => 'verified']) }}" class="btn btn-sm btn-light-success border border-success text-success">
                        {{ __('View Verified') }}
                    </a>
                    <div class="position-absolute end-0 top-0 p-3 text-success"><i class="ti ti-badge-check f-20"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-7">
            <div class="card shadow-none border">
                <div class="card-body">
                    <h5 class="mb-3">{{ __('Admin Notification Panel') }}</h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.landlords.pending') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between px-0">
                            <span>{{ __('Pending landlord applications') }}</span>
                            <span class="badge bg-light-warning border border-warning text-warning">{{ $pendingLandlords ?? 0 }}</span>
                        </a>
                        <a href="{{ route('admin.properties.moderation') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between px-0">
                            <span>{{ __('Unverified property listings') }}</span>
                            <span class="badge bg-light-primary border border-primary text-primary">{{ $pendingProperties ?? 0 }}</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between px-0">
                            <span>{{ __('Total active admin users') }}</span>
                            <span class="badge bg-light-success border border-success text-success">{{ $userCounts['admin'] ?? 0 }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-5">
            <div class="card shadow-none border">
                <div class="card-body">
                    <h5 class="mb-3">{{ __('Quick Actions') }}</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light-primary border border-primary text-primary">
                            <i class="ti ti-users me-1"></i>{{ __('Users Panel') }}
                        </a>
                        <a href="{{ route('admin.landlords.index') }}" class="btn btn-light-secondary border">
                            <i class="ti ti-id-badge-2 me-1"></i>{{ __('Landlord Profiles') }}
                        </a>
                        <a href="{{ route('admin.properties.index') }}" class="btn btn-light-secondary border">
                            <i class="ti ti-building-estate me-1"></i>{{ __('Properties Panel') }}
                        </a>
                        <a href="{{ route('admin.properties.moderation') }}" class="btn btn-light-warning border border-warning text-warning">
                            <i class="ti ti-shield-check me-1"></i>{{ __('Moderation Queue') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-6">
            <div class="card shadow-none border tbl-card">
                <div class="card-body">
                    <h5 class="mb-3">{{ __('Recent Landlords') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Properties') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentLandlords as $landlord)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('admin.landlords.show', $landlord) }}" class="link-primary">{{ $landlord->name }}</a>
                                        </td>
                                        <td>{{ ucfirst($landlord->status ?? 'unknown') }}</td>
                                        <td>{{ $landlord->properties_count }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">{{ __('No landlord records yet.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-6">
            <div class="card shadow-none border tbl-card">
                <div class="card-body">
                    <h5 class="mb-3">{{ __('Recent Properties') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Landlord') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentProperties as $property)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('admin.properties.show', $property) }}" class="link-primary">{{ $property->title }}</a>
                                        </td>
                                        <td>{{ $property->landlord?->name ?? '—' }}</td>
                                        <td>
                                            <span class="badge {{ $property->is_verified ? 'bg-light-success border border-success text-success' : 'bg-light-warning border border-warning text-warning' }}">
                                                {{ $property->is_verified ? __('Verified') : __('Pending') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">{{ __('No property records yet.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
