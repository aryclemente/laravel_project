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
        Schema::create('personas', function (Blueprint $table) {
            $table->integer('idPersonas', true)->unique('idpersonas_unique');
            $table->string('Nombres', 45);
            $table->string('Apellidos', 45);
            $table->integer('Cédula')->unique('cédula_unique');
            $table->date('Fecha_Nacimiento');
            $table->string('Correo_Electrónico', 45);
            $table->string('Teléfono', 45);
            $table->integer('Generos_idGénero')->index('fk_personas_generos1_idx');

            $table->primary(['idPersonas', 'Generos_idGénero']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
