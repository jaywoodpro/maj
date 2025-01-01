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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('label_id')->constrained('product_labels')->onDelete('cascade');

            // General Information
            $table->enum('type', ['indicator', 'bot']);
            $table->string('key', 16)->unique();
            $table->string('application_name');
            $table->string('user_nickname');

            // Account Information
            $table->string('account_number');
            $table->string('account_type');
            $table->string('broker_name');
            $table->boolean('is_live');

            // Status and Expiration
            $table->boolean('is_active');
            $table->date('expiration_date');

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
        Schema::dropIfExists('licenses');
    }
};
