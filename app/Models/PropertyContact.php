<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyContact extends Model
{
    use HasFactory;

    public const TYPE_PHONE = 'phone';
    public const TYPE_WHATSAPP = 'whatsapp';
    public const TYPE_EMAIL = 'email';
    public const TYPE_OTHER = 'other';

    protected $fillable = [
        'property_id',
        'label',
        'type',
        'value',
        'sort_order',
    ];

    public static function contactTypes(): array
    {
        return [
            self::TYPE_PHONE => 'Phone',
            self::TYPE_WHATSAPP => 'WhatsApp',
            self::TYPE_EMAIL => 'Email',
            self::TYPE_OTHER => 'Other',
        ];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
