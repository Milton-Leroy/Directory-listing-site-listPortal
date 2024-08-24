<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_icon',
        'background_image',
        'name',
        'show_at_home',
        'status',
    ];

    public function listings() : HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
