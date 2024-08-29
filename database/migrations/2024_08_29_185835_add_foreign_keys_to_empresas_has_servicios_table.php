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
        Schema::table('empresas_has_servicios', function (Blueprint $table) {
            $table->foreign(['Empresas_idEmpresa'], 'fk_Empresas_has_Servicios_Empresas1')->references(['idEmpresa'])->on('empresas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Servicios_idServicio'], 'fk_Empresas_has_Servicios_Servicios1')->references(['idServicio'])->on('servicios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresas_has_servicios', function (Blueprint $table) {
            $table->dropForeign('fk_Empresas_has_Servicios_Empresas1');
            $table->dropForeign('fk_Empresas_has_Servicios_Servicios1');
        });
    }
};
