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
        Schema::create('personas_has_servicios', function (Blueprint $table) {
            $table->integer('id_Personas_has_Servicios', true)->unique('id_personas_servicios_unique');
            $table->integer('Servicios_idServicio')->index('fk_personas_has_servicios_servicios1_idx');
            $table->integer('Personas_idPersonas')->index('fk_personas_has_servicios_personas1_idx');
            $table->decimal('Costo_Servicio', 10, 0)->nullable();

            $table->primary(['id_Personas_has_Servicios', 'Personas_idPersonas', 'Servicios_idServicio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_has_servicios');
    }
};
