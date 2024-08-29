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
        Schema::table('trabajadores', function (Blueprint $table) {
            $table->foreign(['Cargos_idCargos'], 'fk_Trabajadores_Cargos1')->references(['idCargos'])->on('cargos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Personas_idPersonas'], 'fk_Trabajadores_Personas1')->references(['idPersonas'])->on('personas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trabajadores', function (Blueprint $table) {
            $table->dropForeign('fk_Trabajadores_Cargos1');
            $table->dropForeign('fk_Trabajadores_Personas1');
        });
    }
};
