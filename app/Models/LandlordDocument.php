<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandlordDocument extends Model
{
    use HasFactory;

    public const TYPE_NIDA = 'nida';

    public const TYPE_ELECTRICITY_BILL = 'electricity_bill';

    public const TYPE_WATER_BILL = 'water_bill';

    protected $fillable = [
        'user_id',
        'type',
        'path',
        'original_name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
