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
        Schema::table('company_details', function (Blueprint $table) {
            $table->text('terminos_condiciones')->nullable()->after('contrasena');
            $table->text('politica_privacidad')->nullable()->after('terminos_condiciones');
            $table->text('aviso_legal')->nullable()->after('politica_privacidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_details', function (Blueprint $table) {
            $table->dropColumn(['terminos_condiciones', 'politica_privacidad', 'aviso_legal']);
        });
    }
};