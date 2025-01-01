<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sku', function (Blueprint $table) {
            $table->id();

            // Polymorphic Relationship
            $table->morphs('model');

            // SKU Information
            $table->string('sku')->unique();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sku');
    }
};
