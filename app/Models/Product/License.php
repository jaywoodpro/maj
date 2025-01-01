<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use SoftDeletes;
    protected $fillable = [
        // Foreign Keys
        'user_id',
        'label_id',

        // General Information
        'type',
        'key',
        'application_name',
        'user_nickname',

        // Account Information
        'account_number',
        'account_type',
        'broker_name',
        'is_live',

        // Status and Expiration
        'is_active',
        'expiration_date',
    ];
    protected $casts = [
        'expiration_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function indicators()
    {
        return $this->belongsToMany(Indicator::class, 'indicator_license');
    }
    public function tradingBots()
    {
        return $this->belongsToMany(TradingBot::class, 'trading_bot_license');
    }
    public function label()
    {
        return $this->belongsTo(ProductLabel::class, 'label_id');
    }

}
