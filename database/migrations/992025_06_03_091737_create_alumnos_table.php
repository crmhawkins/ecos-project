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
        Schema::create('alumnos', function (Blueprint $table) {
        $table->id();
        $table->string('username')->unique();
        $table->string('name'); // firstname
        $table->string('surname'); // lastname
        $table->string('email')->unique();
        $table->string('password');
        $table->string('phone')->nullable();
        $table->string('avatar')->nullable();
        $table->string('moodle_id')->nullable(); // ID externo opcional
        $table->timestamps();
        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
