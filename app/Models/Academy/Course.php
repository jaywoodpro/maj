<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'short_description',
        'description',
        'thumbnail',
        'youtube_link',
        'aparat_link',
        'tags',
        'price',
        'discount_price',
        'is_active',
    ];
    protected $casts = [
        'tags' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
