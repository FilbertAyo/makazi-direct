@extends('layouts.clients.app')

@section('title', 'Edit Property')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h1 class="h2 text-capitalize mb-0">Edit property</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('landlord.properties.show', $property) }}" class="btn btn-outline-primary">View</a>
            <a href="{{ route('landlord.properties.index') }}" class="btn btn-outline-secondary">Back to listings</a>
        </div>
    </div>

    <form action="{{ route('landlord.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('clients.properties._form', ['property' => $property, 'propertyTypes' => $propertyTypes])
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="{{ route('landlord.properties.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection
