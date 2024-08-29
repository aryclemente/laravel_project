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
        Schema::table('solicitudes_contratos', function (Blueprint $table) {
            $table->foreign(['Empresas_has_Servicios_idEmpresas_has_Servicioscol'], 'fk_Solicitudes_contratos_Empresas_has_Servicios1')->references(['idEmpresas_has_Servicioscol'])->on('empresas_has_servicios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_Personas_has_Servicios_'], 'fk_Solicitudes_contratos_Personas_has_Servicios1')->references(['id_Personas_has_Servicios'])->on('personas_has_servicios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Tipo_Solicitud_idTipo_Solicitud'], 'fk_Solicitudes_contratos_Tipo_Solicitud1')->references(['idTipo_Solicitud'])->on('tipo_solicitud')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitudes_contratos', function (Blueprint $table) {
            $table->dropForeign('fk_Solicitudes_contratos_Empresas_has_Servicios1');
            $table->dropForeign('fk_Solicitudes_contratos_Personas_has_Servicios1');
            $table->dropForeign('fk_Solicitudes_contratos_Tipo_Solicitud1');
        });
    }
};
