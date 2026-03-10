@extends('layouts.clients.app')

@section('title', 'Add Property')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="h2 text-capitalize mb-0">Add property</h1>
        <a href="{{ route('landlord.properties.index') }}" class="btn btn-outline-secondary">Back to listings</a>
    </div>

    <form action="{{ route('landlord.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('clients.properties._form', ['propertyTypes' => $propertyTypes])
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Create listing</button>
            <a href="{{ route('landlord.properties.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
