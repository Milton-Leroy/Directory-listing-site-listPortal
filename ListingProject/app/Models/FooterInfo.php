<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_description',
        'email',
        'address',
        'phone',
        'copyright'
    ];
}
