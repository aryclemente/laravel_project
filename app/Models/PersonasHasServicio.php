<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonasHasServicio
 *
 * @property int $id_Personas_has_Servicios
 * @property int $Servicios_idServicio
 * @property int $Personas_idPersonas
 * @property float|null $Costo_Servicio
 *
 * @property Persona $persona
 * @property Servicio $servicio
 * @property Collection|SolicitudesContrato[] $solicitudes_contratos
 *
 * @package App\Models
 */
class PersonasHasServicio extends Model
{
	protected $table = 'personas_has_servicios';
	protected $primaryKey = 'id_Personas_has_Servicios';
	public $timestamps = false;

	protected $casts = [
		'Servicios_idServicio' => 'int',
		'Personas_idPersonas' => 'int',
		'Costo_Servicio' => 'float'
	];

	protected $fillable = [
		'Costo_Servicio'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'Personas_idPersonas');
	}

	public function servicio()
	{
		return $this->belongsTo(Servicio::class, 'Servicios_idServicio');
	}

	public function solicitudes_contratos()
	{
		return $this->hasMany(SolicitudesContrato::class, 'id_Personas_has_Servicios_');
	}
}
