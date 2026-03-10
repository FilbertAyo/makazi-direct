<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserApproved
{
    /**
     * Ensure landlord users have approved status before accessing landlord routes.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->hasRole('landlord') && ! $user->isApproved()) {
            return redirect()->route('pending-approval')
                ->with('status', __('Your landlord account is pending approval.'));
        }

        return $next($request);
    }
}
