<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Turno
 * 
 * @property int $idTurnos
 * @property string $Nombre_Turno
 * @property Carbon $Hora_Inicio
 * @property Carbon $Hora_Fin
 * 
 * @property Collection|Cargo[] $cargos
 *
 * @package App\Models
 */
class Turno extends Model
{
	protected $table = 'turnos';
	protected $primaryKey = 'idTurnos';
	public $timestamps = false;

	protected $casts = [
		'Hora_Inicio' => 'datetime',
		'Hora_Fin' => 'datetime'
	];

	protected $fillable = [
		'Nombre_Turno',
		'Hora_Inicio',
		'Hora_Fin'
	];

	public function cargos()
	{
		return $this->hasMany(Cargo::class, 'Turnos_idTurnos1');
	}
}
