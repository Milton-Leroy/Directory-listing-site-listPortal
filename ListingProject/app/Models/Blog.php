<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class,'blog_category_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function comments() : HasMany{
        return $this->hasMany(BlogComment::class, 'blog_id', 'id')->where('status', 1)->orderBy('created_at', 'desc');
    }
}
