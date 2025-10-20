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
        Schema::table('aulas', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->integer('capacity')->nullable()->after('description');
            $table->string('floor')->nullable()->after('capacity');
            $table->string('building')->nullable()->after('floor');
            $table->enum('status', ['disponible', 'ocupada', 'mantenimiento'])->default('disponible')->after('building');
            $table->enum('type', ['aula_teorica', 'laboratorio', 'taller', 'auditorio', 'sala_reuniones', 'biblioteca'])->nullable()->after('status');
            $table->json('equipment')->nullable()->after('type');
            $table->string('responsible')->nullable()->after('equipment');
            $table->string('contact_phone')->nullable()->after('responsible');
            $table->text('available_schedule')->nullable()->after('contact_phone');
            $table->text('observations')->nullable()->after('available_schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aulas', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'capacity',
                'floor',
                'building',
                'status',
                'type',
                'equipment',
                'responsible',
                'contact_phone',
                'available_schedule',
                'observations'
            ]);
        });
    }
};
