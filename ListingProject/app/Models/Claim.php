<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Claim extends Model
{
    use HasFactory;

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
