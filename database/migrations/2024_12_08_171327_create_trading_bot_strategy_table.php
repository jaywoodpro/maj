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
        Schema::create('trading_bot_strategy', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product\TradingBot::class);
            $table->foreignIdFor(\App\Models\Strategy::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_bot_strategy');
    }
};
