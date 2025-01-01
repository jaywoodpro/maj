<?php

namespace App\Models;

use App\Models\Product\Indicator;
use App\Models\Product\TradingBot;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


class Strategy extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'related_links',
        'tags',
        'youtube_link',
        'aparat_link',
        'is_active',
    ];
    protected $casts = [
        // Arrays
        'related_links' => 'array',
        'tags' => 'array',

        // Datetime
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function indicators()
    {
        return $this->belongsToMany(Indicator::class, 'indicator_strategy')
            ->withTimestamps();

    }
    public function tradingBots()
    {
        return $this->belongsToMany(TradingBot::class, 'trading_bot_strategy')
            ->withTimestamps();
    }
    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'model');
    }
}
