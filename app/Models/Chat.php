<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'landlord_id',
        'tenant_id',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function landlord(): BelongsTo
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /** Scope: chats for a given tenant user. */
    public function scopeForTenant(Builder $query, int $tenantId): Builder
    {
        return $query->where('tenant_id', $tenantId);
    }

    /** Scope: chats for a given landlord user. */
    public function scopeForLandlord(Builder $query, int $landlordId): Builder
    {
        return $query->where('landlord_id', $landlordId);
    }

    /** Scope: chats for a specific property (for future inquiry analytics). */
    public function scopeForProperty(Builder $query, int $propertyId): Builder
    {
        return $query->where('property_id', $propertyId);
    }

    /**
     * Returns the Chatify messenger URL to continue this chat between
     * the tenant and the landlord. Useful for building deep-links in
     * admin panels or dashboard notification tiles.
     */
    public function chatifyUrl(): string
    {
        return route('user', ['id' => $this->landlord_id]);
    }
}

