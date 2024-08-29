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
        Schema::create('contratos', function (Blueprint $table) {
            $table->integer('idContratos', true);
            $table->date('Fecha_Inicio');
            $table->date('Fecha_Fin');
            $table->decimal('Remuneración', 10, 0);
            $table->boolean('Status_Contrato');
            $table->integer('Solicitudes_contratos_idSolicitud')->index('fk_contratos_solicitudes_contratos1_idx');
            $table->integer('Cargos_idCargos');
            $table->integer('Cargos_Turnos_idTurnos');

            $table->index(['Cargos_idCargos', 'Cargos_Turnos_idTurnos'], 'fk_contratos_cargos1_idx');
            $table->primary(['idContratos', 'Cargos_idCargos', 'Cargos_Turnos_idTurnos']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
