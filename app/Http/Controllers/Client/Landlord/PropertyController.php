<?php

namespace App\Http\Controllers\Client\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Property::class);

        $properties = auth()->user()
            ->properties()
            ->withCount('images')
            ->with(['images' => fn ($q) => $q->orderBy('sort_order')->limit(1)])
            ->latest()
            ->paginate(10);

        return view('clients.properties.index', compact('properties'));
    }

    public function create(): View
    {
        $this->authorize('create', Property::class);

        return view('clients.properties.create', [
            'propertyTypes' => Property::propertyTypes(),
        ]);
    }

    public function store(StorePropertyRequest $request): RedirectResponse
    {
        $property = auth()->user()->properties()->create($request->safe()->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('property-images/'.$property->id, 'public');
                $property->images()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('landlord.properties.index')
            ->with('status', __('Property listed successfully.'));
    }

    public function show(Property $property): View
    {
        $this->authorize('view', $property);

        $property->load('images');

        return view('clients.properties.show', compact('property'));
    }

    public function edit(Property $property): View
    {
        $this->authorize('update', $property);

        $property->load('images');

        return view('clients.properties.edit', [
            'property' => $property,
            'propertyTypes' => Property::propertyTypes(),
        ]);
    }

    public function update(UpdatePropertyRequest $request, Property $property): RedirectResponse
    {
        $property->update($request->safe()->except(['images', 'remove_images']));

        if ($request->filled('remove_images')) {
            $toRemove = $property->images()->whereIn('id', $request->remove_images)->get();
            foreach ($toRemove as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        if ($request->hasFile('images')) {
            $startOrder = $property->images()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('property-images/'.$property->id, 'public');
                $property->images()->create([
                    'image_path' => $path,
                    'sort_order' => $startOrder + 1 + $index,
                ]);
            }
        }

        return redirect()
            ->route('landlord.properties.show', $property)
            ->with('status', __('Property updated successfully.'));
    }

    public function destroy(Property $property): RedirectResponse
    {
        $this->authorize('delete', $property);

        foreach ($property->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }
        Storage::disk('public')->deleteDirectory('property-images/'.$property->id);
        $property->delete();

        return redirect()
            ->route('landlord.properties.index')
            ->with('status', __('Property deleted.'));
    }
}
