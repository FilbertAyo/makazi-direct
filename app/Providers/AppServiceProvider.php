<?php

namespace App\Providers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer(['layouts.admin.navigation', 'layouts.admin.aside'], function ($view): void {
            $adminNotifications = [
                'pendingLandlords' => 0,
                'pendingProperties' => 0,
                'newUsersThisWeek' => 0,
            ];

            /** @var \App\Models\User|null $currentUser */
            $currentUser = Auth::user();

            if ($currentUser && $currentUser->hasRole('admin')) {
                $adminNotifications = [
                    'pendingLandlords' => User::role('landlord')
                        ->where('status', User::STATUS_PENDING)
                        ->count(),
                    'pendingProperties' => Property::where('is_verified', false)->count(),
                    'newUsersThisWeek' => User::where('created_at', '>=', now()->subDays(7))->count(),
                ];
            }

            $view->with('adminNotifications', $adminNotifications);
        });
    }
}
