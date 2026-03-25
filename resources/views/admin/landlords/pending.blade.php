@php($breadcrumbTitle = __('Pending Landlords'))

<x-app-layout>
    <x-slot name="header">
        <div>
            <h5 class="m-b-10">{{ __('Pending Landlord Applications') }}</h5>
            <p class="text-muted mb-0">{{ __('Review and approve/reject landlord verification requests.') }}</p>
        </div>
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light-secondary border btn-sm">
            <i class="ti ti-arrow-left me-1"></i>{{ __('Back to Admin Dashboard') }}
        </a>
    </div>

    @if ($landlords->isEmpty())
        <div class="card shadow-none border">
            <div class="card-body text-muted">
                {{ __('No pending landlord applications.') }}
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
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Documents') }}</th>
                            <th>{{ __('Applied') }}</th>
                            <th class="text-end">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($landlords as $landlord)
                            <tr>
                                <td>{{ ($landlords->currentPage() - 1) * $landlords->perPage() + $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $landlord->name }}</td>
                                <td>{{ $landlord->phone }}</td>
                                <td>{{ $landlord->email ?? '—' }}</td>
                                <td>
                                    @foreach ($landlord->landlordDocuments as $doc)
                                        <a href="{{ route('admin.documents.show', $doc) }}" target="_blank" rel="noopener" class="d-block text-decoration-none">
                                            <i class="ti ti-file-text me-1"></i>{{ $doc->type === 'nida' ? __('NIDA') : __('Bill') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>{{ $landlord->created_at->format('M j, Y') }}</td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.landlords.show', $landlord) }}" class="btn btn-sm btn-light-primary border border-primary text-primary">
                                            <i class="ti ti-eye me-1"></i>{{ __('View') }}
                                        </a>
                                        <form action="{{ route('admin.landlords.approve', $landlord) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="ti ti-check me-1"></i>{{ __('Approve') }}</button>
                                        </form>
                                        <form action="{{ route('admin.landlords.reject', $landlord) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="ti ti-x me-1"></i>{{ __('Reject') }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body border-top">
                {{ $landlords->links() }}
            </div>
        </div>
    @endif
</x-app-layout>
