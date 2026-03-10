<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    public const TYPE_SINGLE_ROOM = 'single_room';

    public const TYPE_MASTER_BEDROOM = 'master_bedroom';

    public const TYPE_1_BEDROOM = '1_bedroom';

    public const TYPE_2_BEDROOM = '2_bedroom';

    public const TYPE_FULL_HOUSE = 'full_house';

    public static function propertyTypes(): array
    {
        return [
            self::TYPE_SINGLE_ROOM => 'Single room',
            self::TYPE_MASTER_BEDROOM => 'Master bedroom',
            self::TYPE_1_BEDROOM => '1 bedroom',
            self::TYPE_2_BEDROOM => '2 bedroom',
            self::TYPE_FULL_HOUSE => 'Full house',
        ];
    }

    protected $fillable = [
        'landlord_id',
        'title',
        'price',
        'minimum_rent_months',
        'property_type',
        'bedrooms',
        'living_rooms',
        'bathrooms',
        'kitchens',
        'has_fence',
        'has_parking',
        'dimensions',
        'description',
        'latitude',
        'longitude',
        'distance_from_main_road',
        'is_verified',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'has_fence' => 'boolean',
            'has_parking' => 'boolean',
            'is_verified' => 'boolean',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
        ];
    }

    public function landlord(): BelongsTo
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->orderBy('sort_order');
    }

    public function getPropertyTypeLabelAttribute(): string
    {
        return self::propertyTypes()[$this->property_type] ?? $this->property_type;
    }
}
