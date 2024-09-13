<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cargo
 *
 * @property int $idCargos
 * @property string $Nombre_Cargo
 * @property string $Descripción_Cargo
 * @property int $Turnos_idTurnos1
 *
 * @property Turno $turno
 * @property Collection|Contrato[] $contratos
 * @property Collection|Trabajadores[] $trabajadores
 *
 * @package App\Models
 */
class Cargo extends Model
{
	protected $table = 'cargos';
	public $timestamps = false;
	protected $primaryKey = 'idCargos';

	protected $casts = [
		'Turnos_idTurnos1' => 'int'
	];

	protected $fillable = [
		'Nombre_Cargo',
		'Descripción_Cargo'
	];

	public function turno()
	{
		return $this->belongsTo(Turno::class, 'Turnos_idTurnos1');
	}

	public function contratos()
	{
		return $this->hasMany(Contrato::class, 'Cargos_idCargos');
	}

	public function trabajadores()
	{
		return $this->hasMany(Trabajadores::class, 'Cargos_idCargos');
	}
}
