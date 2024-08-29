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
        Schema::create('empresas', function (Blueprint $table) {
            $table->integer('idEmpresa', true)->unique('idempresa_unique');
            $table->string('Nombre_Empresa', 45);
            $table->integer('RIF')->unique('rif_unique');
            $table->string('Dirección', 100);
            $table->string('Teléfono', 45);
            $table->tinyInteger('Status_idStatus');

            $table->primary(['idEmpresa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
