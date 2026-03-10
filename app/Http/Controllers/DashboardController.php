<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Resolve dashboard by role: redirect to tenant, landlord, or admin dashboard.
     */
    public function __invoke(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('landlord')) {
            if (! $user->isApproved()) {
                return redirect()->route('pending-approval')
                    ->with('status', __('Your landlord account is pending approval.'));
            }

            return redirect()->route('landlord.dashboard');
        }

        if ($user->hasRole('tenant')) {
            return redirect()->route('tenant.dashboard');
        }

        return view('dashboard');
    }
}
