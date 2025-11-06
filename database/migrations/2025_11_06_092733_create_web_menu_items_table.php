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
        Schema::create('web_menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // Texto del menú
            $table->string('url'); // URL o ruta
            $table->integer('order')->default(0); // Orden de visualización
            $table->unsignedBigInteger('parent_id')->nullable(); // Para submenús
            $table->boolean('active')->default(true); // Activo/Inactivo
            $table->string('target')->default('_self'); // _self, _blank, etc.
            $table->string('icon')->nullable(); // Icono opcional
            $table->timestamps();
            
            // Índices
            $table->index('order');
            $table->index('parent_id');
            $table->index('active');
            
            // Foreign key para submenús
            $table->foreign('parent_id')->references('id')->on('web_menu_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_menu_items');
    }
};
