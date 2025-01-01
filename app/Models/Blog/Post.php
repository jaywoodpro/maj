<?php

namespace App\Models\Blog;

use App\Models\SeoMeta;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'related_links',
        'tags',
        'youtube_link',
        'aparat_link',
        'status',
        'is_active',
        'published_at',
    ];
    protected $casts = [
        'tags' => 'array',
        'related_links' => 'array',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin', 'super_admin', 'vendor']);
            });
    }
    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'model');
    }
}
