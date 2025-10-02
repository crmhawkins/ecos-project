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
        Schema::table('cursos', function (Blueprint $table) {
            // Cambiar duracion de integer a string para permitir valores como "40 Horas"
            $table->string('duracion')->nullable()->change();
            
            // También ampliar la descripción para evitar truncamiento
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->integer('duracion')->nullable()->change();
            $table->string('description')->nullable()->change();
        });
    }
};
