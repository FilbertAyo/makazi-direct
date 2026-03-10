@extends('layouts.landing')

@section('title', 'All Rentals – ' . config('app.name', 'Makazi Direct'))

@section('content')
<main class="py-5">
    <section class="bg-light py-5">
        <div class="container mt-5">
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h1 class="h3 mb-0 text-capitalize">All Rentals</h1>
                    <p class="text-muted mb-0">
                        Browse all available rooms, apartments and houses on Makazi Direct.
                    </p>
                </div>
            </div>

            <form method="GET" action="{{ route('rentals.index') }}" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label for="location" class="form-label text-uppercase small fw-semibold">Location / Keyword</label>
                    <input type="text" class="form-control" id="location" name="location"
                           placeholder="e.g. Dar es Salaam" value="{{ request('location') }}">
                </div>
                <div class="col-md-2">
                    <label for="type" class="form-label text-uppercase small fw-semibold">Type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="">Any type</option>
                        @foreach ($propertyTypes ?? \App\Models\Property::propertyTypes() as $value => $label)
                            <option value="{{ $value }}" @selected((request('type') ?: (request('purpose') === 'full_house' ? 'full_house' : null)) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="min_price" class="form-label text-uppercase small fw-semibold">Min price</label>
                    <input type="number" class="form-control" id="min_price" name="min_price"
                           placeholder="Min" min="0" value="{{ request('min_price') }}">
                </div>
                <div class="col-md-2">
                    <label for="max_price" class="form-label text-uppercase small fw-semibold">Max price</label>
                    <input type="number" class="form-control" id="max_price" name="max_price"
                           placeholder="Max" min="0" value="{{ request('max_price') }}">
                </div>
                <div class="col-md-2">
                    <label for="min_rent_months" class="form-label text-uppercase small fw-semibold">Min. period</label>
                    <select class="form-select" id="min_rent_months" name="min_rent_months">
                        <option value="">Any</option>
                        <option value="1" @selected(request('min_rent_months') === '1')>1 month</option>
                        <option value="3" @selected(request('min_rent_months') === '3')>3 months</option>
                        <option value="6" @selected(request('min_rent_months') === '6')>6 months</option>
                        <option value="12" @selected(request('min_rent_months') === '12')>12 months</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary btn-lg text-uppercase">Search</button>
                </div>
            </form>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">Available Rentals</h2>
                <span class="text-muted small">
                    @if ($properties->total() > 0)
                        {{ $properties->firstItem() }}–{{ $properties->lastItem() }} of {{ $properties->total() }} listings
                    @else
                        No listings found
                    @endif
                </span>
            </div>

            @if ($properties->isEmpty())
                <div class="text-center py-5 bg-light rounded">
                    <i class="bi bi-house-door display-4 text-muted"></i>
                    <p class="text-muted mt-3 mb-0">No rentals match your criteria. Try adjusting the filters.</p>
                    <a href="{{ route('rentals.index') }}" class="btn btn-outline-primary mt-3">Clear filters</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($properties as $property)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border shadow-none">
                                @if ($property->images->isNotEmpty())
                                    <a href="{{ route('rentals.show', $property) }}">
                                        <img src="{{ $property->images->first()->url }}" class="card-img-top" alt="" style="height: 220px; object-fit: cover;">
                                    </a>
                                @else
                                    <a href="{{ route('rentals.show', $property) }}">
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 220px;">
                                            <i class="bi bi-image fs-1"></i>
                                        </div>
                                    </a>
                                @endif
                                <div class="card-body ">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <h5 class="card-title mb-1">
                                            <a href="{{ route('rentals.show', $property) }}" class="text-dark text-decoration-none">{{ Str::limit($property->title, 40) }}</a>
                                        </h5>
                                        @if ($property->is_verified)
                                            <span class="badge bg-success flex-shrink-0">Verified</span>
                                        @endif
                                    </div>
                                    <p class="card-text mb-1 text-muted small">{{ $property->property_type_label }}</p>
                                    <p class="card-text fw-bold text-primary mb-2">{{ number_format($property->price) }} / month</p>
                                    <ul class="list-inline mb-3 small text-muted">
                                        <li class="list-inline-item me-3"><i class="bi bi-door-open me-1"></i>{{ $property->bedrooms }} bed</li>
                                        <li class="list-inline-item me-3"><i class="bi bi-droplet me-1"></i>{{ $property->bathrooms }} bath</li>
                                        <li class="list-inline-item"><i class="bi bi-calendar-month me-1"></i>Min {{ $property->minimum_rent_months }} mo</li>
                                    </ul>
                                    <a href="{{ route('rentals.show', $property) }}" class="btn btn-outline-primary btn-sm">View details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $properties->links() }}
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
