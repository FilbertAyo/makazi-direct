@extends('layouts.clients.app')

@section('title', 'Landlord Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="h2 text-capitalize mb-0">Dashboard</h1>
        <p class="text-muted mb-0 small">Manage your properties and listings</p>
    </div>

    @php
        $listingsCount = auth()->user()->properties()->count();
        $verifiedCount = auth()->user()->properties()->where('is_verified', true)->count();
    @endphp
    {{-- Overview cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('landlord.properties.index') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-house-door fs-4 text-primary"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Total listings</div>
                            <div class="h4 mb-0">{{ $listingsCount }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-chat-dots fs-4 text-success"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Active chats</div>
                        <div class="h4 mb-0">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-eye fs-4 text-warning"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Views (this month)</div>
                        <div class="h4 mb-0">—</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-info bg-opacity-10 p-3 me-3">
                        <i class="bi bi-patch-check fs-4 text-info"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Verified listings</div>
                        <div class="h4 mb-0">{{ $verifiedCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- My Listings section --}}
    <section id="listings" class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h2 class="h5 text-capitalize mb-0">My Listings</h2>
                <a href="{{ route('landlord.properties.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add property
                </a>
            </div>
            <div class="card-body">
                @if ($listingsCount === 0)
                    <p class="text-muted mb-0">You have no listings yet. Add your first property to start receiving inquiries from tenants.</p>
                    <a href="{{ route('landlord.properties.create') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-lg me-1"></i> Add property
                    </a>
                @else
                    <p class="text-muted mb-0">You have {{ $listingsCount }} listing(s). View, edit or add more.</p>
                    <a href="{{ route('landlord.properties.index') }}" class="btn btn-outline-primary mt-3">View all listings</a>
                @endif
            </div>
        </div>
    </section>

    {{-- Chats section --}}
    <section id="chats" class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h2 class="h5 text-capitalize mb-0">Incoming chats</h2>
                <a href="{{ route('chatify') }}" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-chat-dots me-1"></i> Open messenger
                </a>
            </div>
            <div class="card-body">
                <p class="text-muted mb-0">When tenants message you about a listing, conversations will appear in the messenger.</p>
                <a href="{{ route('chatify') }}" class="btn btn-success mt-3">
                    <i class="bi bi-chat-dots me-1"></i> View all chats
                </a>
            </div>
        </div>
    </section>
@endsection
