@php($breadcrumbTitle = __('Landlord Profile'))

<x-app-layout>
    <x-slot name="header">
        <div>
            <h5 class="m-b-10">{{ __('Landlord Profile') }}</h5>
            <p class="mb-0 text-muted">{{ __('Detailed landlord account, documents, and listing overview.') }}</p>
        </div>
    </x-slot>

    <div class="mb-4 d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.landlords.index') }}" class="btn btn-light-secondary border btn-sm"><i class="ti ti-arrow-left me-1"></i>{{ __('Back to Profiles') }}</a>
        <a href="{{ route('admin.properties.index', ['landlord_id' => $landlord->id]) }}" class="btn btn-light-primary border border-primary text-primary btn-sm"><i class="ti ti-building-estate me-1"></i>{{ __('View Landlord Properties') }}</a>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-xl-4">
            <div class="card shadow-none border h-100">
                <div class="card-body">
                    <h6 class="mb-3">{{ __('Account Information') }}</h6>
                    <p class="mb-2"><strong>{{ __('Name:') }}</strong> {{ $landlord->name }}</p>
                    <p class="mb-2"><strong>{{ __('Email:') }}</strong> {{ $landlord->email ?? '—' }}</p>
                    <p class="mb-2"><strong>{{ __('Phone:') }}</strong> {{ $landlord->phone ?? '—' }}</p>
                    <p class="mb-2">
                        <strong>{{ __('Status:') }}</strong>
                        <span class="badge
                            {{ $landlord->status === \App\Models\User::STATUS_ACTIVE ? 'bg-light-success border border-success text-success' : '' }}
                            {{ $landlord->status === \App\Models\User::STATUS_PENDING ? 'bg-light-warning border border-warning text-warning' : '' }}
                            {{ $landlord->status === \App\Models\User::STATUS_REJECTED ? 'bg-light-danger border border-danger text-danger' : '' }}">
                            {{ ucfirst($landlord->status ?? 'unknown') }}
                        </span>
                    </p>
                    <p class="mb-0"><strong>{{ __('Joined:') }}</strong> {{ $landlord->created_at->format('M j, Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card shadow-none border h-100">
                <div class="card-body">
                    <h6 class="mb-3">{{ __('Summary') }}</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <h5 class="mb-1">{{ $landlord->landlordDocuments->count() }}</h5>
                                <p class="mb-0 text-muted">{{ __('Verification Documents') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <h5 class="mb-1">{{ $landlord->properties->count() }}</h5>
                                <p class="mb-0 text-muted">{{ __('Total Properties') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <h5 class="mb-1">{{ $landlord->properties->where('is_verified', true)->count() }}</h5>
                                <p class="mb-0 text-muted">{{ __('Verified Properties') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-none border tbl-card mb-3">
        <div class="card-body">
            <h6 class="mb-3">{{ __('Submitted Documents') }}</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Original Name') }}</th>
                            <th>{{ __('Submitted At') }}</th>
                            <th class="text-end">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($landlord->landlordDocuments as $doc)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $doc->type)) }}</td>
                                <td>{{ $doc->original_name }}</td>
                                <td>{{ $doc->created_at->format('M j, Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.documents.show', $doc) }}" target="_blank" rel="noopener" class="btn btn-sm btn-light-primary border border-primary text-primary">
                                        <i class="ti ti-download me-1"></i>{{ __('View') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">{{ __('No documents submitted.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow-none border tbl-card">
        <div class="card-body">
            <h6 class="mb-3">{{ __('Properties by Landlord') }}</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Verification') }}</th>
                            <th class="text-end">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($landlord->properties as $property)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $property->title }}</td>
                                <td>{{ $property->property_type_label }}</td>
                                <td>{{ number_format((float) $property->price) }}</td>
                                <td>
                                    <span class="badge {{ $property->is_verified ? 'bg-light-success border border-success text-success' : 'bg-light-warning border border-warning text-warning' }}">
                                        {{ $property->is_verified ? __('Verified') : __('Pending') }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.properties.show', $property) }}" class="btn btn-sm btn-light-primary border border-primary text-primary">{{ __('View') }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">{{ __('No properties available for this landlord.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
