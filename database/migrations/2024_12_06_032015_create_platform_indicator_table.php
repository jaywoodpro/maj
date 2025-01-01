<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('platform_indicator', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('indicator_id')->constrained()->onDelete('cascade');
            $table->foreignId('platform_id')->constrained()->onDelete('cascade');

            // Version and Files
            $table->string('version')->nullable(); // حذف فاصله اضافی در نام ستون
            $table->longText('changelog')->nullable();
            $table->string('main_file')->nullable();
            $table->string('demo_file')->nullable();

            // Timestamps
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('platform_indicator');
    }
};
