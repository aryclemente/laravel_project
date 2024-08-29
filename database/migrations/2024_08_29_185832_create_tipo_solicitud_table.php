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
        Schema::create('tipo_solicitud', function (Blueprint $table) {
            $table->integer('idTipo_Solicitud', true)->unique('idtipo_solicitud_unique');
            $table->string('Tipo_Solicitud', 45)->nullable();

            $table->primary(['idTipo_Solicitud']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_solicitud');
    }
};
