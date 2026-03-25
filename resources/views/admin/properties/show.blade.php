@php($breadcrumbTitle = __('Property Details'))

<x-app-layout>
    <x-slot name="header">
        <div>
            <h5 class="m-b-10">{{ __('Property Details') }}</h5>
            <p class="mb-0 text-muted">{{ __('View full listing information, contacts, and verification controls.') }}</p>
        </div>
    </x-slot>

    <div class="mb-4 d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.properties.index') }}" class="btn btn-light-secondary border btn-sm"><i class="ti ti-arrow-left me-1"></i>{{ __('Back to Properties') }}</a>
        @if ($property->landlord)
            <a href="{{ route('admin.landlords.show', $property->landlord) }}" class="btn btn-light-primary border border-primary text-primary btn-sm">{{ __('View Landlord Profile') }}</a>
        @endif
        @if (! $property->is_verified)
            <form action="{{ route('admin.properties.approve', $property) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm"><i class="ti ti-check me-1"></i>{{ __('Approve Property') }}</button>
            </form>
        @else
            <form action="{{ route('admin.properties.unverify', $property) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-warning btn-sm"><i class="ti ti-shield-off me-1"></i>{{ __('Move to Moderation') }}</button>
            </form>
        @endif
    </div>

    <div class="row g-3">
        <div class="col-xl-8">
            <div class="card shadow-none border">
                <div class="card-body">
                    <h5 class="mb-3">{{ $property->title }}</h5>
                    <p class="text-muted mb-3">{{ $property->description ?: __('No description provided.') }}</p>
                    @if ($property->house_rules)
                        <h6>{{ __('House Rules & Policies') }}</h6>
                        <p class="mb-0">{!! nl2br(e($property->house_rules)) !!}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow-none border">
                <div class="card-body">
                    <h6 class="mb-3">{{ __('Listing Summary') }}</h6>
                    <p class="mb-2"><strong>{{ __('Type:') }}</strong> {{ $property->property_type_label }}</p>
                    <p class="mb-2"><strong>{{ __('Price:') }}</strong> {{ number_format((float) $property->price) }}</p>
                    <p class="mb-2"><strong>{{ __('Minimum Rent:') }}</strong> {{ $property->minimum_rent_months }} {{ __('months') }}</p>
                    <p class="mb-2"><strong>{{ __('Landlord:') }}</strong> {{ $property->landlord?->name ?? '—' }}</p>
                    <p class="mb-0">
                        <strong>{{ __('Status:') }}</strong>
                        <span class="badge {{ $property->is_verified ? 'bg-light-success border border-success text-success' : 'bg-light-warning border border-warning text-warning' }}">
                            {{ $property->is_verified ? __('Verified') : __('Pending') }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card shadow-none border tbl-card h-100">
                <div class="card-body">
                    <h6 class="mb-3">{{ __('Property Contacts') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Label') }}</th>
                                    <th>{{ __('Value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($property->contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($contact->type) }}</td>
                                        <td>{{ $contact->label ?? '—' }}</td>
                                        <td>{{ $contact->value }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">{{ __('No contacts added.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card shadow-none border tbl-card h-100">
                <div class="card-body">
                    <h6 class="mb-3">{{ __('Property Images') }}</h6>
                    @if ($property->images->isEmpty())
                        <p class="text-muted mb-0">{{ __('No images uploaded.') }}</p>
                    @else
                        <div class="row g-2">
                            @foreach ($property->images as $image)
                                <div class="col-6">
                                    <img src="{{ $image->url }}" alt="" class="img-fluid rounded border">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
