<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnos_cursos', function (Blueprint $table) {
            $table->unique(['alumno_id', 'curso_id'], 'alumnos_cursos_unique');
        });
    }

    public function down(): void
    {
        Schema::table('alumnos_cursos', function (Blueprint $table) {
            $table->dropUnique('alumnos_cursos_unique');
        });
    }
};
