<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trabajadore
 * 
 * @property int $idTrabajador
 * @property int $Codigo_Trabajador
 * @property int $Status_Trabajador
 * @property int $Personas_idPersonas
 * @property int $Cargos_idCargos
 * 
 * @property Cargo $cargo
 * @property Persona $persona
 *
 * @package App\Models
 */
class Trabajadore extends Model
{
	protected $table = 'trabajadores';
	public $timestamps = false;

	protected $casts = [
		'Codigo_Trabajador' => 'int',
		'Status_Trabajador' => 'int',
		'Personas_idPersonas' => 'int',
		'Cargos_idCargos' => 'int'
	];

	protected $fillable = [
		'Codigo_Trabajador',
		'Status_Trabajador'
	];

	public function cargo()
	{
		return $this->belongsTo(Cargo::class, 'Cargos_idCargos');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'Personas_idPersonas');
	}
}
