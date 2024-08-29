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
        Schema::table('personas_has_servicios', function (Blueprint $table) {
            $table->foreign(['Personas_idPersonas'], 'fk_Personas_has_Servicios_Personas1')->references(['idPersonas'])->on('personas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Servicios_idServicio'], 'fk_Personas_has_Servicios_Servicios1')->references(['idServicio'])->on('servicios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas_has_servicios', function (Blueprint $table) {
            $table->dropForeign('fk_Personas_has_Servicios_Personas1');
            $table->dropForeign('fk_Personas_has_Servicios_Servicios1');
        });
    }
};
