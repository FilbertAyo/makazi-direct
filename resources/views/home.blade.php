@extends('layouts.landing')

@section('title', 'Makazi Direct – Direct Housing Marketplace')

@section('content')
    <section id="billboard">
        <div class="container py-5">
            <div class="row flex-lg-row-reverse align-items-center ">
                <div class="col-lg-6">
                    <img src="{{ asset('assets/images/billboard.png') }}" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="text-capitalize lh-1 my-3">Perfect way to rent and manage homes</h1>
                    <p class="lead">A direct housing marketplace connecting tenants and landlords with no brokers, built for the Tanzanian market and beyond.</p>
                    <form method="GET" action="{{ route('rentals.index') }}" class="navbar navbar-expand-lg billboard-nav navbar-light">
                        <div class="container billboard-search p-0 bg-white rounded-3 shadow-sm">
                            <div class="row billboard-row">
                                <div class="col-lg-3 billboard-select">
                                    <label class="visually-hidden" for="billboard-purpose">Purpose</label>
                                    <select class="form-select mb-2 mb-lg-0" name="purpose" id="billboard-purpose" aria-label="Purpose">
                                        <option value="">Purpose</option>
                                        <option value="rent">Rent</option>
                                        <option value="full_house">Full house only</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 billboard-select">
                                    <label class="visually-hidden" for="billboard-location">Location</label>
                                    <select class="form-select mb-2 mb-lg-0" name="location" id="billboard-location" aria-label="Location">
                                        <option value="">Location</option>
                                        <option value="Dar es Salaam">Dar es Salaam</option>
                                        <option value="Arusha">Arusha</option>
                                        <option value="Mwanza">Mwanza</option>
                                        <option value="Dodoma">Dodoma</option>
                                        <option value="Mbeya">Mbeya</option>
                                        <option value="Moshi">Moshi</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 billboard-select">
                                    <label class="visually-hidden" for="billboard-type">Property type</label>
                                    <select class="form-select mb-2 mb-lg-0" name="type" id="billboard-type" aria-label="Type">
                                        <option value="">Type</option>
                                        <option value="single_room">Single room</option>
                                        <option value="master_bedroom">Master bedroom</option>
                                        <option value="1_bedroom">1 bedroom</option>
                                        <option value="2_bedroom">2 bedroom</option>
                                        <option value="full_house">Full house</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 billboard-btn">
                                    <button type="submit" class="btn btn-primary btn-lg billboard-search w-100">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="feature">
        <div class="container py-5">
            <div class="row">
                <div class="section-header align-center mb-5">
                    <h2 class="text-capitalize m-0">Featured In</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-between">
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="logo 1" style="width: 158.667px; margin-right: 20px;">
                        <img alt="logo" src="{{ asset('assets/images/logo1.png') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="logo 2" style="width: 158.667px; margin-right: 20px;">
                        <img alt="logo" src="{{ asset('assets/images/logo2.png') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="logo 3" style="width: 158.667px; margin-right: 20px;">
                        <img alt="logo" src="{{ asset('assets/images/logo3.png') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="logo 4" style="width: 158.667px; margin-right: 20px;">
                        <img alt="logo" src="{{ asset('assets/images/logo4.png') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="my-3" role="group" aria-label="logo 5" style="width: 158.667px; margin-right: 20px;">
                        <img alt="logo" src="{{ asset('assets/images/logo6.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light">
        <div class="container my-5 py-5">
            <h2 class="text-capitalize m-0 py-lg-5">Popular Residences</h2>
            <div class="swiper-button-next residence-swiper-next residence-arrow"></div>
            <div class="swiper-button-prev residence-swiper-prev residence-arrow"></div>
            <div class="swiper residence-swiper">
                <div class="swiper-wrapper">
                    @forelse ($properties ?? [] as $property)
                        <div class="swiper-slide">
                            <div class="card">
                                <a href="{{ route('rentals.show', $property) }}">
                                    @if ($property->images->isNotEmpty())
                                        <img src="{{ $property->images->first()->url }}" class="card-img-top" alt="{{ $property->title }}" style="height: 220px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 220px;">
                                            <i class="bi bi-image fs-1"></i>
                                        </div>
                                    @endif
                                </a>
                                <div class="card-body p-0">
                                    <a href="{{ route('rentals.show', $property) }}">
                                        <h5 class="card-title pt-4">{{ Str::limit($property->title, 35) }}</h5>
                                    </a>
                                    <p class="card-text">{{ $property->property_type_label }}</p>
                                    <p class="card-text fw-bold text-primary">{{ number_format($property->price) }} / month</p>
                                    <div class="card-text">
                                        <ul class="d-flex">
                                            <li class="residence-list">
                                                <img src="{{ asset('assets/images/bed.png') }}" alt="bed"> {{ $property->bedrooms }} bed
                                            </li>
                                            <li class="residence-list">
                                                <img src="{{ asset('assets/images/bath.png') }}" alt="bath"> {{ $property->bathrooms }} bath
                                            </li>
                                            <li class="residence-list">
                                                <img src="{{ asset('assets/images/square.png') }}" alt="area"> Min {{ $property->minimum_rent_months }} mo
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 220px;">
                                    <i class="bi bi-house-door fs-1"></i>
                                </div>
                                <div class="card-body p-0">
                                    <p class="card-text pt-4 text-muted">No listings yet. Check back soon.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="residence-btn">
                <a href="{{ route('rentals.index') }}" class="btn btn-primary btn-lg my-5">View All Rentals</a>
            </div>
        </div>
    </section>

    <section id="about-us">
        <div class="container">
            <div class="row py-lg-5">
                <h2 class="text-capitalize text-center m-0 py-lg-5">Why choose Makazi Direct</h2>
                <div class="text-center col-lg-4">
                    <img src="{{ asset('assets/images/search.png') }}" class="bd-placeholder-img rounded-circle" alt="Easy to find" width="140" height="140" loading="lazy">
                    <h4 class="fw-normal mt-5">Easy to find</h4>
                    <p>Search by location, property type, price and more to quickly find homes that match your needs.</p>
                </div>
                <div class="text-center col-lg-4">
                    <img src="{{ asset('assets/images/price.png') }}" class="bd-placeholder-img rounded-circle" alt="Affordable prices" width="140" height="140" loading="lazy">
                    <h4 class="fw-normal mt-5">Affordable Prices</h4>
                    <p>Connect directly with landlords, reduce middleman fees and keep your monthly rent under control.</p>
                </div>
                <div class="text-center col-lg-4">
                    <img src="{{ asset('assets/images/time.png') }}" class="bd-placeholder-img rounded-circle" alt="Quick process" width="140" height="140" loading="lazy">
                    <h4 class="fw-normal mt-5">Quickly Process</h4>
                    <p>From browsing to first contact, our in-app chat keeps your housing search fast and organised.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonial">
        <div class="container my-5">
            <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="row my-5 py-lg-5">
                            <div class="col-md-8 mx-auto">
                                <img src="{{ asset('assets/images/quote.png') }}" class="rounded mx-auto d-inline" alt="quote">
                                <p class="testimonial-p mt-4">
                                    “Makazi Direct helped me find a new room within a week, directly from a landlord, without paying any broker fees.”
                                </p>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="pt-5 mb-1">Elena Pravo</p>
                                        <p class="">Tenant</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row my-5 py-lg-5">
                            <div class="col-md-8 mx-auto">
                                <img src="{{ asset('assets/images/quote.png') }}" class="rounded mx-auto d-inline" alt="quote">
                                <p class="testimonial-p mt-4">
                                    “As a landlord, it’s now easier to reach serious tenants and keep all messages in one place.”
                                </p>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="pt-5 mb-1">Juma Ally</p>
                                        <p class="">Landlord</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-swiper-button col-md-3 position-absolute">
                    <div class="swiper-button-prev testimonial-arrow"></div>
                    <div class="arrow-divider"> | </div>
                    <div class="swiper-button-next testimonial-arrow"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="help" class="py-5" style="background: linear-gradient(270deg, #EFF6FF 0.01%, rgba(239, 246, 255, 0.00) 100%);">
        <div class="container-lg my-5">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="image-holder d-flex">
                        <img src="{{ asset('assets/images/group.png') }}" class="img-fluid" alt="We help people find homes" loading="lazy">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-content ps-md-5 mt-4 mt-md-0">
                        <h2 class="text-capitalize">We help people to find homes</h2>
                        <p>
                            Makazi Direct is built for tenants and landlords: list, search and connect through one simple platform, ready for future features like payments, reviews and premium listings.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
