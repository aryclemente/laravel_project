<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trabajadores
 *
 * @property int $idTrabajador
 * @property int $Codigo_Trabajador
 * @property int $Status_Trabajador
 * @property int $Personas_idPersonas
 * @property int $Cargos_idCargos
 * @property int $Turnos_idTurnos
 *
 * @property Cargo $cargo
 * @property Persona $persona
 * @property Turno $turno
 *
 * @package App\Models
 */
class Trabajadores extends Model
{
	protected $table = 'trabajadores';
	public $timestamps = false;
	protected $primaryKey = 'idTrabajador';

	protected $casts = [
		'Codigo_Trabajador' => 'int',
		'Status_Trabajador' => 'int',
		'Personas_idPersonas' => 'int',
		'Cargos_idCargos' => 'int',
		'Turnos_idTurnos' => 'int'
	];

	protected $fillable = [
		'Codigo_Trabajador',
		'Status_Trabajador',
		'Turnos_idTurnos'
	];

	public function cargo()
	{
		return $this->belongsTo(Cargo::class, 'Cargos_idCargos');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'Personas_idPersonas');
	}
	public function turno()
	{
		return $this->belongsTo(Turno::class, 'Turnos_idTurnos');
	}

	public function solicitudes_contratos()
	{
		return $this->hasMany(Contrato::class, 'id_Trabajador_id');
	}
}
