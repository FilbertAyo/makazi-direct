@extends('layouts.clients.app')

@section('title', 'My Listings')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="h2 text-capitalize mb-0">My Listings</h1>
        <a href="{{ route('landlord.properties.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add property
        </a>
    </div>

    @if ($properties->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-house-door display-4 text-muted"></i>
                <p class="text-muted mt-3 mb-0">You have no listings yet.</p>
                <a href="{{ route('landlord.properties.create') }}" class="btn btn-primary mt-3">Add your first property</a>
            </div>
        </div>
    @else
        <div class="card border shadow-sm">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">Image</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Beds / Baths</th>
                            <th>Min. period</th>
                            <th>Verified</th>
                            <th class="text-end" style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($properties as $property)
                            <tr>
                                <td class="align-middle text-center">
                                    @if ($property->images->isNotEmpty())
                                        <img src="{{ $property->images->first()->url }}" alt="" class="rounded" style="width: 60px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted"><i class="bi bi-image"></i></span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('landlord.properties.show', $property) }}" class="text-dark text-decoration-none fw-medium">{{ Str::limit($property->title, 40) }}</a>
                                </td>
                                <td class="align-middle">{{ $property->property_type_label }}</td>
                                <td class="align-middle">{{ number_format($property->price) }} / mo</td>
                                <td class="align-middle">{{ $property->bedrooms }} / {{ $property->bathrooms }}</td>
                                <td class="align-middle">{{ $property->minimum_rent_months }} mo</td>
                                <td class="align-middle">
                                    @if ($property->is_verified)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="align-middle text-end">
                                    <a href="{{ route('landlord.properties.show', $property) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    <a href="{{ route('landlord.properties.edit', $property) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('landlord.properties.destroy', $property) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this listing?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $properties->links() }}
        </div>
    @endif
@endsection
