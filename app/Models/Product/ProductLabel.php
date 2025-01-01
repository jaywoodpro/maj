<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLabel extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'type',
        'title',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function tradingBot()
    {
        return $this->hasOne(TradingBot::class);
    }
    public function indicator()
    {
        return $this->hasOne(Indicator::class);
    }
    public function license()
    {
        return $this->hasOne(License::class, 'label_id');
    }
}
