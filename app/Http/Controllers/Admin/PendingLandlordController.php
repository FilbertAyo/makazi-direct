<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandlordDocument;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PendingLandlordController extends Controller
{
    public function index(): View
    {
        $landlords = User::role('landlord')
            ->where('status', User::STATUS_PENDING)
            ->with('landlordDocuments')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.landlords.pending', compact('landlords'));
    }

    public function approve(User $user): RedirectResponse
    {
        $this->authorizeLandlord($user);

        $user->update(['status' => User::STATUS_ACTIVE]);

        return redirect()
            ->route('admin.landlords.pending')
            ->with('status', __('Landlord approved.'));
    }

    public function reject(User $user): RedirectResponse
    {
        $this->authorizeLandlord($user);

        $user->update(['status' => User::STATUS_REJECTED]);

        return redirect()
            ->route('admin.landlords.pending')
            ->with('status', __('Landlord application rejected.'));
    }

    public function showDocument(LandlordDocument $document): StreamedResponse
    {
        $user = $document->user;
        if (! $user->hasRole('landlord')) {
            abort(404);
        }

        if (! Storage::disk('local')->exists($document->path)) {
            abort(404);
        }

        return Storage::disk('local')->download(
            $document->path,
            $document->original_name ?? 'document'
        );
    }

    private function authorizeLandlord(User $user): void
    {
        if (! $user->hasRole('landlord')) {
            abort(404);
        }
    }
}
