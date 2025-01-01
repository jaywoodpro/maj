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
        Schema::create('platform_trading_bot', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('trading_bot_id')->constrained()->onDelete('cascade');
            $table->foreignId('platform_id')->constrained()->onDelete('cascade');

            // Version and Files
            $table->string('version')->nullable();
            $table->longText('changelog')->nullable();
            $table->string('main_file')->nullable();
            $table->string('demo_file')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_trading_bot');
    }
};
