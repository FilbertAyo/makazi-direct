@extends('layouts.clients.app')

@section('title', $property->title)

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="h2 text-capitalize mb-0">{{ $property->title }}</h1>
        <div class="d-flex gap-2">
            @if ($property->is_verified)
                <span class="badge bg-success align-self-center">Verified</span>
            @endif
            <a href="{{ route('landlord.properties.edit', $property) }}" class="btn btn-outline-primary">Edit</a>
            <a href="{{ route('landlord.properties.index') }}" class="btn btn-outline-secondary">Back to listings</a>
            <form action="{{ route('landlord.properties.destroy', $property) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this listing?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            @if ($property->images->isNotEmpty())
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($property->images as $index => $img)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $img->url }}" class="d-block w-100" alt="" style="height: 400px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if ($property->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center py-5 bg-light text-muted">
                        <i class="bi bi-image display-4"></i>
                        <p class="mt-2 mb-0">No photos</p>
                    </div>
                </div>
            @endif

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h2 class="h5 mb-0">Description</h2>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $property->description ?: 'No description.' }}</p>
                    @if ($property->dimensions)
                        <hr>
                        <p class="mb-0 small text-muted"><strong>Dimensions / room sizes:</strong> {{ $property->dimensions }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <p class="h4 text-primary mb-3">{{ number_format($property->price) }} <span class="fs-6 fw-normal text-muted">/ month</span></p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><strong>Type:</strong> {{ $property->property_type_label }}</li>
                        <li class="mb-2"><strong>Min. rental:</strong> {{ $property->minimum_rent_months }} months</li>
                        <li class="mb-2"><strong>Bedrooms:</strong> {{ $property->bedrooms }}</li>
                        <li class="mb-2"><strong>Living rooms:</strong> {{ $property->living_rooms }}</li>
                        <li class="mb-2"><strong>Bathrooms:</strong> {{ $property->bathrooms }}</li>
                        <li class="mb-2"><strong>Kitchens:</strong> {{ $property->kitchens }}</li>
                        <li class="mb-2"><strong>Fence:</strong> {{ $property->has_fence ? 'Yes' : 'No' }}</li>
                        <li class="mb-2"><strong>Parking:</strong> {{ $property->has_parking ? 'Yes' : 'No' }}</li>
                        @if ($property->distance_from_main_road)
                            <li class="mb-2"><strong>From main road:</strong> {{ $property->distance_from_main_road }}</li>
                        @endif
                        @if ($property->latitude && $property->longitude)
                            <li class="mb-2"><strong>Location:</strong> {{ $property->latitude }}, {{ $property->longitude }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
