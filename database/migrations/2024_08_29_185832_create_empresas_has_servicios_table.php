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
        Schema::create('empresas_has_servicios', function (Blueprint $table) {
            $table->integer('idEmpresas_has_Servicioscol', true)->unique('idempresas_has_servicioscol_unique');
            $table->decimal('Costo_Servicio', 10, 0)->nullable();
            $table->integer('Empresas_idEmpresa')->index('fk_empresas_has_servicios_empresas1_idx');
            $table->integer('Servicios_idServicio')->index('fk_empresas_has_servicios_servicios1_idx');

            $table->primary(['idEmpresas_has_Servicioscol', 'Empresas_idEmpresa', 'Servicios_idServicio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas_has_servicios');
    }
};
