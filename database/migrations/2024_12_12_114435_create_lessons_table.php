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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            // General Information
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('sort_description')->nullable();
            $table->text('description')->nullable();

            // Media and Links
            $table->string('video')->nullable();

            // Tags and Metadata
            $table->json('tags')->nullable();

            // Flags and Options
            $table->boolean('is_active')->default(true);

            // Timestamps and Soft Deletes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
