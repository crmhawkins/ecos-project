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
            $table->string('description')->nullable();
            $table->string('moodle_id')->nullable();
            $table->date('inicio')->nullable();
            $table->integer('duracion')->nullable();
            $table->integer('plazas')->nullable();
            $table->integer('lecciones')->nullable();
            $table->boolean('certificado')->default(0);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('moodle_id');
            $table->dropColumn('inicio');
            $table->dropColumn('duracion');
            $table->dropColumn('plazas');
            $table->dropColumn('lecciones');
            $table->dropColumn('certificado');
        });
    }
};
