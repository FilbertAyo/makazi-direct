@extends('layouts.clients.app')

@section('title', 'Landlord Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="h2 text-capitalize mb-0">Dashboard</h1>
        <p class="text-muted mb-0 small">Manage your properties and listings</p>
    </div>

    {{-- Overview cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-house-door fs-4 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total listings</div>
                        <div class="h4 mb-0">0</div>
                    </div>
                </div>
            </div>
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
                        <div class="h4 mb-0">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- My Listings section --}}
    <section id="listings" class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h2 class="h5 text-capitalize mb-0">My Listings</h2>
            </div>
            <div class="card-body">
                <p class="text-muted mb-0">You have no listings yet. Add your first property to start receiving inquiries from tenants.</p>
                <a href="#add" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-lg me-1"></i> Add property
                </a>
            </div>
        </div>
    </section>

    {{-- Add Property section (placeholder for upload rooms) --}}
    <section id="add" class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h2 class="h5 text-capitalize mb-0">Add property</h2>
            </div>
            <div class="card-body">
                <p class="text-muted">Upload rooms and property details here. Form and image upload will be implemented in the next step.</p>
                <div class="border rounded p-4 text-center text-muted bg-light">
                    <i class="bi bi-cloud-arrow-up display-6"></i>
                    <p class="mt-2 mb-0">Property creation form coming soon</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Chats section --}}
    <section id="chats" class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h2 class="h5 text-capitalize mb-0">Incoming chats</h2>
            </div>
            <div class="card-body">
                <p class="text-muted mb-0">When tenants message you about a listing, conversations will appear here.</p>
                <div class="border rounded p-4 text-center text-muted bg-light mt-3">
                    <i class="bi bi-chat-left-text display-6"></i>
                    <p class="mt-2 mb-0">No chats yet</p>
                </div>
            </div>
        </div>
    </section>
@endsection
