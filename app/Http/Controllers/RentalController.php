<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RentalController extends Controller
{
    public function index(Request $request): View
    {
        $query = Property::query()
            ->with(['images' => fn ($q) => $q->orderBy('sort_order')->limit(1)])
            ->latest();

        if ($request->filled('location')) {
            $term = $request->location;
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%")
                    ->orWhere('distance_from_main_road', 'like', "%{$term}%");
            });
        }

        $propertyType = $request->filled('purpose') && $request->purpose === 'full_house'
            ? 'full_house'
            : $request->type;
        if ($propertyType) {
            $query->where('property_type', $propertyType);
        }

        if ($request->filled('min_price') && is_numeric($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price') && is_numeric($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('min_rent_months') && is_numeric($request->min_rent_months)) {
            $query->where('minimum_rent_months', '<=', (int) $request->min_rent_months);
        }

        $properties = $query->paginate(12)->withQueryString();

        return view('rentals.index', [
            'properties' => $properties,
            'propertyTypes' => Property::propertyTypes(),
        ]);
    }

    public function show(Property $property): View
    {
        $property->load(['images', 'landlord']);

        return view('rentals.show', compact('property'));
    }
}
