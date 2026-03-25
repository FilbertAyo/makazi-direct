<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $userCounts = [
            'all' => User::count(),
            'admin' => User::role('admin')->count(),
            'tenant' => User::role('tenant')->count(),
            'landlord' => User::role('landlord')->count(),
        ];

        $pendingLandlords = User::role('landlord')
            ->where('status', User::STATUS_PENDING)
            ->count();

        $pendingProperties = Property::where('is_verified', false)->count();
        $verifiedProperties = Property::where('is_verified', true)->count();

        $recentLandlords = User::role('landlord')
            ->withCount('properties')
            ->latest()
            ->take(5)
            ->get();

        $recentProperties = Property::query()
            ->with('landlord')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'userCounts',
            'pendingLandlords',
            'pendingProperties',
            'verifiedProperties',
            'recentLandlords',
            'recentProperties'
        ));
    }
}
