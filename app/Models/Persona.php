<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 *
 * @property int $idPersonas
 * @property string $Nombres
 * @property string $Apellidos
 * @property int $Cédula
 * @property Carbon $Fecha_Nacimiento
 * @property string $Correo_Electrónico
 * @property string $Teléfono
 * @property int $Generos_idGénero
 *
 * @property Genero $genero
 * @property Collection|Servicio[] $servicios
 * @property Collection|Trabajadore[] $trabajadores
 *
 * @package App\Models
 */
class Persona extends Model
{
	protected $table = 'personas';
	protected $primaryKey = 'idPersonas';

	public $timestamps = false;

	protected $casts = [
		'Cédula' => 'int',
		'Fecha_Nacimiento' => 'datetime',
		'Generos_idGénero' => 'int'
	];

	protected $fillable = [
		'Nombres',
		'Apellidos',
		'Cédula',
		'Fecha_Nacimiento',
		'Correo_Electrónico',
		'Teléfono'
	];

	public function genero()
	{
		return $this->belongsTo(Genero::class, 'Generos_idGénero');
	}

	public function servicios()
	{
		return $this->belongsToMany(Servicio::class, 'personas_has_servicios', 'Personas_idPersonas', 'Servicios_idServicio')
			->withPivot('id_Personas_has_Servicios', 'Costo_Servicio');
	}

	public function trabajadores()
	{
		return $this->hasMany(Trabajadores::class, 'Personas_idPersonas');
	}
}
