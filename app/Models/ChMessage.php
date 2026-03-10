<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;

class ChMessage extends Model
{
    use UUID;

    protected $fillable = [
        'id',
        'from_id',
        'to_id',
        'body',
        'attachment',
        'seen',
    ];

    protected $casts = [
        'seen' => 'boolean',
    ];
}
