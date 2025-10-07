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
        // Índices para la tabla cursos
        Schema::table('cursos', function (Blueprint $table) {
            $table->index(['inactive', 'published', 'moodle_id'], 'idx_cursos_active_published');
            $table->index(['category_id', 'inactive', 'published'], 'idx_cursos_category_active');
            $table->index(['inactive', 'published', 'created_at'], 'idx_cursos_active_created');
        });

        // Índices para la tabla cursos_category
        Schema::table('cursos_category', function (Blueprint $table) {
            $table->index('inactive', 'idx_categories_inactive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar índices de la tabla cursos
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropIndex('idx_cursos_active_published');
            $table->dropIndex('idx_cursos_category_active');
            $table->dropIndex('idx_cursos_active_created');
        });

        // Eliminar índices de la tabla cursos_category
        Schema::table('cursos_category', function (Blueprint $table) {
            $table->dropIndex('idx_categories_inactive');
        });
    }
};
