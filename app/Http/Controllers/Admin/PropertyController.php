<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(Request $request): View
    {
        $landlordId = $request->integer('landlord_id');
        $verification = $request->query('verification');

        $query = Property::query()
            ->with(['landlord', 'images', 'contacts'])
            ->latest();

        if ($landlordId > 0) {
            $query->where('landlord_id', $landlordId);
        }

        if ($verification === 'verified') {
            $query->where('is_verified', true);
        } elseif ($verification === 'pending') {
            $query->where('is_verified', false);
        }

        $properties = $query->paginate(15)->withQueryString();
        $landlords = User::role('landlord')->orderBy('name')->get(['id', 'name']);

        return view('admin.properties.index', compact('properties', 'landlords', 'landlordId', 'verification'));
    }

    public function moderation(): View
    {
        $properties = Property::query()
            ->with(['landlord', 'images'])
            ->where('is_verified', false)
            ->latest()
            ->paginate(15);

        return view('admin.properties.moderation', compact('properties'));
    }

    public function show(Property $property): View
    {
        $property->load(['landlord', 'images', 'contacts']);

        return view('admin.properties.show', compact('property'));
    }

    public function approve(Property $property): RedirectResponse
    {
        $property->update(['is_verified' => true]);

        return back()->with('status', __('Property verified successfully.'));
    }

    public function unverify(Property $property): RedirectResponse
    {
        $property->update(['is_verified' => false]);

        return back()->with('status', __('Property moved back to moderation queue.'));
    }
}
