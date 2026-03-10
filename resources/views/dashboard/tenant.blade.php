@extends('layouts.clients.app')

@section('title', 'Tenant Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="h2 text-capitalize mb-0">Dashboard</h1>
        <p class="text-muted mb-0 small">Browse rentals and manage your activity</p>
    </div>

    {{-- Overview cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-search fs-4 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Explore rentals</div>
                        <div class="h4 mb-0">
                            <a href="{{ route('rentals.index') }}" class="stretched-link text-decoration-none text-dark">
                                Start browsing
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('chatify') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-3 bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-chat-dots fs-4 text-success"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Active chats</div>
                            <div class="h4 mb-0">Open</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-heart fs-4 text-warning"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Saved properties</div>
                        <div class="h4 mb-0">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-info bg-opacity-10 p-3 me-3">
                        <i class="bi bi-eye fs-4 text-info"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Recently viewed</div>
                        <div class="h4 mb-0">—</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Saved / suggested rentals --}}
    <section class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h2 class="h5 text-capitalize mb-0">Your rentals</h2>
                <a href="{{ route('rentals.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-search me-1"></i> Find a home
                </a>
            </div>
            <div class="card-body">
                <p class="text-muted mb-0">
                    You haven’t saved any properties yet. Browse listings and save the ones you like to keep track of them here.
                </p>
                <a href="{{ route('rentals.index') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-search me-1"></i> Browse rentals
                </a>
            </div>
        </div>
    </section>

    {{-- Chats section --}}
    <section id="chats" class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h2 class="h5 text-capitalize mb-0">Chats with landlords</h2>
                <a href="{{ route('chatify') }}" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-chat-dots me-1"></i> Open messenger
                </a>
            </div>
            <div class="card-body">
                <p class="text-muted mb-0">
                    Click a listing's "Chat with landlord" button to start a conversation.
                    All your conversations are managed in the messenger.
                </p>
                <div class="d-flex gap-2 mt-3 flex-wrap">
                    <a href="{{ route('chatify') }}" class="btn btn-success">
                        <i class="bi bi-chat-dots me-1"></i> View all chats
                    </a>
                    <a href="{{ route('rentals.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-search me-1"></i> Browse rentals
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
