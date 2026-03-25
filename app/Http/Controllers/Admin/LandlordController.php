<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandlordController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $validStatuses = [User::STATUS_ACTIVE, User::STATUS_PENDING, User::STATUS_REJECTED];

        $query = User::role('landlord')
            ->withCount('properties')
            ->withCount('landlordDocuments')
            ->latest();

        if ($status && in_array($status, $validStatuses, true)) {
            $query->where('status', $status);
        }

        $landlords = $query->paginate(15)->withQueryString();

        return view('admin.landlords.index', compact('landlords', 'status'));
    }

    public function show(User $user): View
    {
        abort_unless($user->hasRole('landlord'), 404);

        $user->load([
            'landlordDocuments',
            'properties' => fn ($query) => $query->with('images')->latest(),
        ]);

        return view('admin.landlords.show', [
            'landlord' => $user,
        ]);
    }
}
