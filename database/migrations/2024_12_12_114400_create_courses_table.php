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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // General Information
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();

            // Media and Links
            $table->string('thumbnail')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('aparat_link')->nullable();

            // Tags and Metadata
            $table->json('tags')->nullable();

            // Pricing
            $table->decimal('price', 10, 0)->nullable();
            $table->decimal('discount_price', 10, 0)->nullable();

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
        Schema::dropIfExists('courses');
    }
};
