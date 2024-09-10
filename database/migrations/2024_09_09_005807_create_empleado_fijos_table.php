<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoFijosTable extends Migration
{
    public function up()
    {
        Schema::create('empleado_fijos', function (Blueprint $table) {
            $table->id(); // ID autoincrementable
            $table->integer('personas_id'); // Debe coincidir con el tipo de datos en la tabla 'personas'
            $table->integer('cargos_id'); // Debe coincidir con el tipo de datos en la tabla 'cargos'
            $table->integer('turnos_id'); // Debe coincidir con el tipo de datos en la tabla 'turnos'
            $table->timestamps(); // Para created_at y updated_at

            // Definir las claves foráneas
            $table->foreign('personas_id')->references('idPersonas')->on('personas')->onDelete('cascade');
            $table->foreign('cargos_id')->references('idCargos')->on('cargos')->onDelete('cascade');
            $table->foreign('turnos_id')->references('idTurnos')->on('turnos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleado_fijos');
    }
}

