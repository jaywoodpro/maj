<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // اطلاعات حساب
            $table->string('platform')->nullable();
            $table->string('account_type')->nullable();
            $table->string('broker_name')->nullable();
            $table->string('base_currency')->default('USD');

            // اطلاعات معامله
            $table->string('trade_id')->nullable();
            $table->string('pair');
            $table->timestamp('entry_date')->nullable(); // اجازه NULL
            $table->timestamp('exit_date')->nullable(); // اجازه NULL
            $table->decimal('entry_price', 15, 2);
            $table->decimal('exit_price', 15, 2);
            $table->string('position_type');
            $table->string('leverage')->nullable();
            $table->decimal('stop_loss', 15, 2)->nullable();
            $table->decimal('take_profit', 15, 2)->nullable();
            $table->decimal('pip_gain_loss', 15, 2)->nullable();
            $table->decimal('commission', 15, 2)->nullable();
            $table->decimal('swap_fee', 15, 2)->nullable();

            // نتایج مالی
            $table->decimal('profit_loss', 15, 2);
            $table->decimal('profit_loss_percentage', 15, 2)->nullable();
            $table->decimal('balance_before', 15, 2)->nullable();
            $table->decimal('balance_after', 15, 2)->nullable();
            $table->decimal('risk_reward_ratio', 15, 2)->nullable();
            $table->decimal('drawdown', 15, 2)->nullable();

            // اطلاعات تحلیلی
            $table->string('analysis_type');
            $table->text('entry_reason');
            $table->text('exit_reason');
            $table->json('indicators_used')->nullable();
            $table->json('timeframes');
            $table->text('market_conditions');
            $table->text('news_events')->nullable();

            // احساسات و مدیریت روانشناسی
            $table->text('emotions_before_trade')->nullable();
            $table->text('emotions_after_trade')->nullable();
            $table->text('psychological_notes')->nullable();

            // اطلاعات مدیریت ریسک
            $table->decimal('risk_percentage', 15, 2)->nullable();
            $table->decimal('capital_risked', 15, 2)->nullable();
            $table->decimal('max_drawdown_allowed', 15, 2)->nullable();

            // جزئیات استراتژی
            $table->string('strategy_name');
            $table->text('strategy_rules')->nullable();
            $table->text('backtest_results')->nullable();
            $table->decimal('win_rate', 5, 2)->nullable();

            // تنظیمات
            $table->boolean('is_public')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
