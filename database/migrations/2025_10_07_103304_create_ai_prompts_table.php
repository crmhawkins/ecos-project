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
        Schema::create('ai_prompts', function (Blueprint $table) {
            $table->id();
            $table->string('category')->index(); // courses, general, contact, etc.
            $table->string('name');
            $table->text('prompt');
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0);
            $table->json('variables')->nullable(); // Variables dinámicas disponibles
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_prompts');
    }
};
