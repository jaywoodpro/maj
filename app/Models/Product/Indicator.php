<?php

namespace App\Models\Product;

use App\Models\Platform;
use App\Models\SeoMeta;
use App\Models\Strategy;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Indicator extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        // Foreign Keys
        'user_id',
        'label_id',

        // General Information
        'title',
        'slug',
        'short_description',
        'description',

        // Media and Links
        'thumbnail',
        'youtube_link',
        'aparat_link',
        'catalog_file',
        'gallery',
        'main_file',
        'demo_file',
        'related_links',

        'tags',

        // Pricing
        'price',
        'discount_price',

        // Flags and Options
        'is_best_offer',
        'is_international',
        'is_active',
    ];
    protected $casts = [
        // Arrays
        'gallery' => 'array',
        'related_links' => 'array',
        'tags' => 'array',

        // Datetime
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function strategies()
    {
        return $this->belongsToMany(Strategy::class, 'indicator_strategy')
            ->withTimestamps();
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin', 'super_admin', 'vendor']);
            });
    }
    public function label()
    {
        return $this->belongsTo(ProductLabel::class, 'label_id')
            ->where('type', 'indicator')
            ->whereNotIn('id', Indicator::where('id', '!=', $this->id)->pluck('label_id'))
            ->orWhere('id', Indicator::where('id', $this->id)->value('label_id'));
    }
    public function sku()
    {
        return $this->morphOne(Sku::class, 'model');
    }
    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'platform_indicator')
            ->withPivot(['version', 'changelog', 'main_file', 'demo_file'])
            ->withTimestamps();
    }
    public function licenses()
    {
        return $this->belongsToMany(License::class, 'indicator_license');
    }
    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'model');
    }
}
