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
        Schema::create('solicitudes_contratos', function (Blueprint $table) {
            $table->integer('idSolicitud', true)->unique('idvacante_unique');
            $table->date('Fecha_solicitud');
            $table->boolean('Status_solicitud');
            $table->integer('Tipo_Solicitud_idTipo_Solicitud')->nullable()->index('fk_solicitudes_contratos_tipo_solicitud1_idx');
            $table->integer('id_Personas_has_Servicios_')->nullable()->index('fk_solicitudes_contratos_personas_has_servicios1_idx');
            $table->integer('Empresas_has_Servicios_idEmpresas_has_Servicioscol')->nullable()->index('fk_solicitudes_contratos_empresas_has_servicios1_idx');
            $table->timestamp('deleted_at')->nullable();
            $table->primary(['idSolicitud']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_contratos');
    }
};
