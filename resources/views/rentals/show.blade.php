@extends('layouts.landing')

@section('title', $property->title . ' – ' . config('app.name', 'Makazi Direct'))

@section('content')
<main class="py-5">
    <div class="container py-5 mt-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rentals.index') }}">Rentals</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($property->title, 50) }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <div class="col-lg-8">
                @if ($property->images->isNotEmpty())
                    <div class="card border-0 shadow-sm mb-4">
                        <div id="rentalCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($property->images as $index => $img)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $img->url }}" class="d-block w-100" alt="" style="height: 450px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if ($property->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#rentalCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#rentalCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
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
                        <p class="mb-0">{{ $property->description ?: 'No description provided.' }}</p>
                        @if ($property->dimensions)
                            <hr>
                            <p class="mb-0 small text-muted"><strong>Dimensions / room sizes:</strong> {{ $property->dimensions }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h1 class="h4 mb-0">{{ $property->title }}</h1>
                            @if ($property->is_verified)
                                <span class="badge bg-success">Verified</span>
                            @endif
                        </div>
                        <p class="h3 text-primary mb-3">{{ number_format($property->price) }} <span class="fs-6 fw-normal text-muted">/ month</span></p>

                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="bi bi-tag me-2 text-muted"></i>{{ $property->property_type_label }}</li>
                            <li class="mb-2"><i class="bi bi-calendar-month me-2 text-muted"></i>Minimum {{ $property->minimum_rent_months }} months</li>
                            <li class="mb-2"><i class="bi bi-door-open me-2 text-muted"></i>{{ $property->bedrooms }} bedroom(s)</li>
                            <li class="mb-2"><i class="bi bi-droplet me-2 text-muted"></i>{{ $property->bathrooms }} bathroom(s)</li>
                            <li class="mb-2"><i class="bi bi-house me-2 text-muted"></i>{{ $property->living_rooms }} living room(s)</li>
                            <li class="mb-2"><i class="bi bi-egg-fried me-2 text-muted"></i>{{ $property->kitchens }} kitchen(s)</li>
                            <li class="mb-2"><i class="bi bi-check2-circle me-2 text-muted"></i>Fence: {{ $property->has_fence ? 'Yes' : 'No' }}</li>
                            <li class="mb-2"><i class="bi bi-car-front me-2 text-muted"></i>Parking: {{ $property->has_parking ? 'Yes' : 'No' }}</li>
                            @if ($property->distance_from_main_road)
                                <li class="mb-2"><i class="bi bi-signpost me-2 text-muted"></i>{{ $property->distance_from_main_road }} from main road</li>
                            @endif
                        </ul>

                        @auth
                            <a href="#" class="btn btn-primary w-100 mb-2">Start chat with landlord</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Log in to contact landlord</a>
                        @endauth
                        <a href="{{ route('rentals.index') }}" class="btn btn-outline-secondary w-100">Back to rentals</a>
                    </div>
                </div>

                @if ($property->landlord)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="h6 text-uppercase text-muted mb-2">Listed by</h3>
                            <p class="mb-0">{{ $property->landlord->name }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
