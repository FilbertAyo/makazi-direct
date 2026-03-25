@php($breadcrumbTitle = __('Users'))

<x-app-layout>
    <x-slot name="header">
        <div>
            <h5 class="m-b-10">{{ __('Users') }}</h5>
            <p class="text-muted mb-0">{{ __('Manage registered users by role and status.') }}</p>
        </div>
    </x-slot>

    <div class="card shadow-none border mb-4">
        <div class="card-body">
            <h6 class="mb-3">{{ __('Filter by role') }}</h6>
            <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.users.index') }}"
               class="btn btn-sm {{ $role === null ? 'btn-primary' : 'btn-light-secondary' }}">
                {{ __('All Users') }}
            </a>
            <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
               class="btn btn-sm {{ $role === 'admin' ? 'btn-primary' : 'btn-light-secondary' }}">
                {{ __('Admins') }}
            </a>
            <a href="{{ route('admin.users.index', ['role' => 'tenant']) }}"
               class="btn btn-sm {{ $role === 'tenant' ? 'btn-primary' : 'btn-light-secondary' }}">
                {{ __('Tenants') }}
            </a>
            <a href="{{ route('admin.users.index', ['role' => 'landlord']) }}"
               class="btn btn-sm {{ $role === 'landlord' ? 'btn-primary' : 'btn-light-secondary' }}">
                {{ __('Landlords') }}
            </a>
            </div>
        </div>
    </div>

    @if ($users->isEmpty())
        <div class="card shadow-none border">
            <div class="card-body text-muted">
                {{ $role ? __('No users found for this role.') : __('No users yet.') }}
            </div>
        </div>
    @else
        <div class="card shadow-none border tbl-card">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Role') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Registered') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email ?? '—' }}</td>
                                <td>{{ $user->phone ?? '—' }}</td>
                                <td>
                                    @foreach ($user->roles as $r)
                                        <span class="badge bg-light-primary border border-primary text-primary text-capitalize">{{ $r->name }}</span>
                                    @endforeach
                                    @if ($user->roles->isEmpty())
                                        —
                                    @endif
                                </td>
                                <td>
                                    <span class="badge
                                        {{ $user->status === \App\Models\User::STATUS_ACTIVE ? 'bg-light-success border border-success text-success' : '' }}
                                        {{ $user->status === \App\Models\User::STATUS_PENDING ? 'bg-light-warning border border-warning text-warning' : '' }}
                                        {{ $user->status === \App\Models\User::STATUS_REJECTED ? 'bg-light-danger border border-danger text-danger' : '' }}
                                        {{ !in_array($user->status ?? '', [\App\Models\User::STATUS_ACTIVE, \App\Models\User::STATUS_PENDING, \App\Models\User::STATUS_REJECTED], true) ? 'bg-light-secondary border border-secondary text-secondary' : '' }}">
                                        {{ $user->status ?? '—' }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('M j, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body border-top">
                {{ $users->links() }}
            </div>
        </div>
    @endif
</x-app-layout>
