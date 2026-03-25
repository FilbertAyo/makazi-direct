@php($breadcrumbTitle = __('Landlord Profiles'))

<x-app-layout>
    <x-slot name="header">
        <div>
            <h5 class="m-b-10">{{ __('Landlord Profiles') }}</h5>
            <p class="mb-0 text-muted">{{ __('Manage landlord accounts, statuses, and profile summaries.') }}</p>
        </div>
    </x-slot>

    <div class="card shadow-none border mb-4">
        <div class="card-body">
            <h6 class="mb-3">{{ __('Filter by status') }}</h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.landlords.index') }}" class="btn btn-sm {{ $status === null ? 'btn-primary' : 'btn-light-secondary' }}">{{ __('All') }}</a>
                <a href="{{ route('admin.landlords.index', ['status' => \App\Models\User::STATUS_ACTIVE]) }}" class="btn btn-sm {{ $status === \App\Models\User::STATUS_ACTIVE ? 'btn-primary' : 'btn-light-secondary' }}">{{ __('Active') }}</a>
                <a href="{{ route('admin.landlords.index', ['status' => \App\Models\User::STATUS_PENDING]) }}" class="btn btn-sm {{ $status === \App\Models\User::STATUS_PENDING ? 'btn-primary' : 'btn-light-secondary' }}">{{ __('Pending') }}</a>
                <a href="{{ route('admin.landlords.index', ['status' => \App\Models\User::STATUS_REJECTED]) }}" class="btn btn-sm {{ $status === \App\Models\User::STATUS_REJECTED ? 'btn-primary' : 'btn-light-secondary' }}">{{ __('Rejected') }}</a>
            </div>
        </div>
    </div>

    <div class="card shadow-none border tbl-card">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Documents') }}</th>
                        <th>{{ __('Properties') }}</th>
                        <th>{{ __('Registered') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($landlords as $landlord)
                        <tr>
                            <td>{{ ($landlords->currentPage() - 1) * $landlords->perPage() + $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $landlord->name }}</td>
                            <td>{{ $landlord->phone ?? '—' }}</td>
                            <td>{{ $landlord->email ?? '—' }}</td>
                            <td>
                                <span class="badge
                                    {{ $landlord->status === \App\Models\User::STATUS_ACTIVE ? 'bg-light-success border border-success text-success' : '' }}
                                    {{ $landlord->status === \App\Models\User::STATUS_PENDING ? 'bg-light-warning border border-warning text-warning' : '' }}
                                    {{ $landlord->status === \App\Models\User::STATUS_REJECTED ? 'bg-light-danger border border-danger text-danger' : '' }}">
                                    {{ ucfirst($landlord->status ?? 'unknown') }}
                                </span>
                            </td>
                            <td>{{ $landlord->landlord_documents_count }}</td>
                            <td>{{ $landlord->properties_count }}</td>
                            <td>{{ $landlord->created_at->format('M j, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.landlords.show', $landlord) }}" class="btn btn-sm btn-light-primary border border-primary text-primary">
                                    <i class="ti ti-eye me-1"></i>{{ __('View') }}
                                </a>
                                <a href="{{ route('admin.properties.index', ['landlord_id' => $landlord->id]) }}" class="btn btn-sm btn-light-secondary border">
                                    <i class="ti ti-building-estate me-1"></i>{{ __('Properties') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">{{ __('No landlord profiles found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            {{ $landlords->links() }}
        </div>
    </div>
</x-app-layout>
