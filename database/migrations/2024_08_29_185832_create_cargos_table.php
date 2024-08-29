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
        Schema::create('cargos', function (Blueprint $table) {
            $table->integer('idCargos', true)->unique('idcargos_unique');
            $table->string('Nombre_Cargo', 45);
            $table->string('Descripción_Cargo', 45);
            $table->integer('Turnos_idTurnos1')->index('fk_cargos_turnos1_idx');

            $table->primary(['idCargos', 'Turnos_idTurnos1']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
