@php($breadcrumbTitle = __('Landlord Properties'))

<x-app-layout>
    <x-slot name="header">
        <div>
            <h5 class="m-b-10">{{ __('Landlord Properties') }}</h5>
            <p class="mb-0 text-muted">{{ __('Browse and manage all landlord listings.') }}</p>
        </div>
    </x-slot>

    <div class="card shadow-none border mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.properties.index') }}" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label">{{ __('Landlord') }}</label>
                    <select name="landlord_id" class="form-select">
                        <option value="">{{ __('All Landlords') }}</option>
                        @foreach ($landlords as $landlord)
                            <option value="{{ $landlord->id }}" @selected($landlordId === $landlord->id)>{{ $landlord->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">{{ __('Verification') }}</label>
                    <select name="verification" class="form-select">
                        <option value="">{{ __('All') }}</option>
                        <option value="verified" @selected($verification === 'verified')>{{ __('Verified') }}</option>
                        <option value="pending" @selected($verification === 'pending')>{{ __('Pending') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Apply Filters') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-none border tbl-card">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Landlord') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Contacts') }}</th>
                        <th>{{ __('Verification') }}</th>
                        <th>{{ __('Created') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($properties as $property)
                        <tr>
                            <td>{{ ($properties->currentPage() - 1) * $properties->perPage() + $loop->iteration }}</td>
                            <td>{{ $property->title }}</td>
                            <td>
                                @if ($property->landlord)
                                    <a href="{{ route('admin.landlords.show', $property->landlord) }}" class="link-primary">{{ $property->landlord->name }}</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $property->property_type_label }}</td>
                            <td>{{ number_format((float) $property->price) }}</td>
                            <td>{{ $property->contacts->count() }}</td>
                            <td>
                                <span class="badge {{ $property->is_verified ? 'bg-light-success border border-success text-success' : 'bg-light-warning border border-warning text-warning' }}">
                                    {{ $property->is_verified ? __('Verified') : __('Pending') }}
                                </span>
                            </td>
                            <td>{{ $property->created_at->format('M j, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.properties.show', $property) }}" class="btn btn-sm btn-light-primary border border-primary text-primary">{{ __('View') }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">{{ __('No properties found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            {{ $properties->links() }}
        </div>
    </div>
</x-app-layout>
