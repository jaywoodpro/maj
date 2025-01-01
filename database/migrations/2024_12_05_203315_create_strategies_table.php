<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('strategies', function (Blueprint $table) {
            $table->id();

            // General Information
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');

            // Media
            $table->string('thumbnail');
            $table->string('youtube_link')->nullable();
            $table->string('aparat_link')->nullable();
            $table->json('related_links')->nullable();
            $table->json('tags')->nullable();

            // Flags and Options
            $table->boolean('is_active')->default(true);

            // Timestamps and Soft Deletes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('strategies');
    }
};
