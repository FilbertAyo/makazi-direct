<?php

namespace App\Http\Controllers\Client\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChMessage;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * Start or continue a Chatify conversation between the tenant and the
     * property's landlord. We also keep a lightweight Chat record that links
     * the conversation to the property (for future analytics / payment flows).
     */
    public function store(Property $property): RedirectResponse
    {
        $tenant = Auth::user();

        if (! $tenant || ! $tenant->hasRole('tenant')) {
            abort(403);
        }

        $landlord = $property->landlord;

        if (! $landlord) {
            return back()->withErrors(['error' => __('This property does not have a landlord assigned.')]);
        }

        if ($landlord->id === $tenant->id) {
            return back()->withErrors(['error' => __('You cannot start a chat with yourself.')]);
        }

        // Keep our domain record (property → chat link) so we can later query
        // "how many inquiries per listing" without touching Chatify's tables.
        Chat::firstOrCreate([
            'property_id' => $property->id,
            'landlord_id' => $landlord->id,
            'tenant_id'   => $tenant->id,
        ]);

        // Send the first Chatify message only if this tenant has never messaged
        // this landlord before (Chatify stores messages in ch_messages).
        $alreadyMessaged = ChMessage::where('from_id', $tenant->id)
            ->where('to_id', $landlord->id)
            ->exists();

        if (! $alreadyMessaged) {
            $propertyUrl  = route('rentals.show', $property);
            $introMessage = __('Hi! I am interested in your property: :title (:url). Is it still available?', [
                'title' => $property->title,
                'url'   => $propertyUrl,
            ]);

            ChMessage::create([
                'id'      => (string) Str::uuid(),
                'from_id' => $tenant->id,
                'to_id'   => $landlord->id,
                'body'    => $introMessage,
                'seen'    => false,
            ]);
        }

        // Redirect into Chatify messenger, pre-opening the landlord's conversation.
        return redirect()->route('user', ['id' => $landlord->id]);
    }
}

