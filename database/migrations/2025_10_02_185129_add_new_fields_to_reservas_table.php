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
        Schema::table('reservas', function (Blueprint $table) {
            // Nuevos campos para el sistema mejorado de reservas
            $table->string('titulo')->nullable()->after('id');
            $table->text('descripcion')->nullable()->after('titulo');
            $table->string('solicitante')->nullable()->after('descripcion');
            $table->string('email_contacto')->nullable()->after('solicitante');
            $table->integer('numero_asistentes')->nullable()->after('alumnos');
            $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media')->after('estado');
            $table->text('equipamiento_requerido')->nullable()->after('prioridad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn([
                'titulo',
                'descripcion',
                'solicitante',
                'email_contacto',
                'numero_asistentes',
                'prioridad',
                'equipamiento_requerido'
            ]);
        });
    }
};
