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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->integer('idTrabajador', true)->unique('idtrabajadores_unique');
            $table->integer('Codigo_Trabajador');
            $table->tinyInteger('Status_Trabajador');
            $table->integer('Personas_idPersonas')->index('fk_trabajadores_personas1_idx');
            $table->integer('Cargos_idCargos')->index('fk_trabajadores_cargos1_idx');

            $table->primary(['idTrabajador', 'Cargos_idCargos', 'Personas_idPersonas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};
