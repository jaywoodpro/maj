<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        // Hidden Field
        'user_id',

        // Step: اطلاعات حساب
        'account_type',
        'platform',
        'broker_name',
        'base_currency',

        // Step: اطلاعات معامله
        'trade_id',
        'pair',
        'entry_date',
        'exit_date',
        'entry_price',
        'exit_price',
        'position_type',
        'leverage',
        'stop_loss',
        'take_profit',
        'pip_gain_loss',
        'commission',
        'swap_fee',

        // Step: نتایج مالی
        'profit_loss',
        'profit_loss_percentage',
        'balance_before',
        'balance_after',
        'risk_reward_ratio',
        'drawdown',

        // Step: اطلاعات تحلیلی
        'analysis_type',
        'entry_reason',
        'exit_reason',
        'indicators_used',
        'timeframes',
        'market_conditions',
        'news_events',

        // Step: احساسات و مدیریت روانشناسی
        'emotions_before_trade',
        'emotions_after_trade',
        'psychological_notes',

        // Step: اطلاعات مدیریت ریسک
        'risk_percentage',
        'capital_risked',
        'max_drawdown_allowed',

        // Step: جزئیات استراتژی
        'strategy_name',
        'strategy_rules',
        'backtest_results',
        'win_rate',

        // Step: تنظیمات
        'is_public',
    ];
    protected $casts = [
        'indicators_used' => 'array',
        'timeframes' => 'array',
        'entry_date' => 'datetime',
        'exit_date' => 'datetime',
        'is_public' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
