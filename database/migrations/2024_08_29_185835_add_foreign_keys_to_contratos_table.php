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
        Schema::table('contratos', function (Blueprint $table) {
            $table->foreign(['Cargos_idCargos'], 'fk_Contratos_Cargos1')->references(['idCargos'])->on('cargos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Solicitudes_contratos_idSolicitud'], 'fk_Contratos_Solicitudes_contratos1')->references(['idSolicitud'])->on('solicitudes_contratos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign('fk_Contratos_Cargos1');
            $table->dropForeign('fk_Contratos_Solicitudes_contratos1');
        });
    }
};
