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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('curso');
            $table->string('profesor');
            $table->string('contacto_profesor')->nullable();
            $table->string('hora_inicio')->nullable();
            $table->string('hora_fin')->nullable();
            $table->string('dias')->nullable(); // ejemplo: "Lunes, Miércoles, Viernes"
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('alumnos')->nullable();
            $table->boolean('informatica')->default(false);
            $table->boolean('homologada')->default(false);
            $table->unsignedBigInteger('aula_id')->nullable();
            $table->string('archivo')->nullable(); // ruta al archivo subido
            $table->string('estado')->nullable(); // ruta al archivo subido
            $table->text('observaciones')->nullable();
            $table->boolean('inactive')->default(0);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
