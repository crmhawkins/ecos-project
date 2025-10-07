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
        Schema::create('ai_assistant_config', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('assistant_name')->default('Asistente ECOS');
            $table->text('welcome_message')->nullable();
            $table->text('system_prompt')->nullable();
            $table->string('ai_model')->default('gpt-3.5-turbo');
            $table->decimal('temperature', 3, 2)->default(0.7);
            $table->integer('max_tokens')->default(1000);
            $table->boolean('show_courses')->default(true);
            $table->boolean('show_contact_info')->default(true);
            $table->string('primary_color')->default('#D93690');
            $table->string('secondary_color')->default('#667eea');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_assistant_config');
    }
};
