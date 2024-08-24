<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'order_id',
        'purchase_date',
        'expiry_date',
        'status',
    ];

    function package() : BelongsTo
    {
        return $this->belongsTo(package::class)->withTrashed();
    }
}
