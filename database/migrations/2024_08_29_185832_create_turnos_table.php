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
        Schema::create('turnos', function (Blueprint $table) {
            $table->integer('idTurnos', true)->unique('idturnos_unique');
            $table->string('Nombre_Turno', 45);
            $table->time('Hora_Inicio');
            $table->time('Hora_Fin');

            $table->primary(['idTurnos']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
