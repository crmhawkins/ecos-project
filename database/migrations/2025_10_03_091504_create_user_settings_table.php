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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('admin_user')->onDelete('cascade');
            $table->string('language', 10)->default('es');
            $table->string('timezone', 50)->default('Europe/Madrid');
            $table->enum('theme', ['light', 'dark'])->default('light');
            $table->boolean('email_notifications')->default(true);
            $table->boolean('system_notifications')->default(true);
            $table->json('additional_settings')->nullable();
            $table->timestamps();
            
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
