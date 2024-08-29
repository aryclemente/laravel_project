<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicio
 * 
 * @property int $idServicio
 * @property string $Nombre_Servicio
 * @property string $Descripción_Servicio
 * 
 * @property Collection|Empresa[] $empresas
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Servicio extends Model
{
	protected $table = 'servicios';
	protected $primaryKey = 'idServicio';
	public $timestamps = false;

	protected $fillable = [
		'Nombre_Servicio',
		'Descripción_Servicio'
	];

	public function empresas()
	{
		return $this->belongsToMany(Empresa::class, 'empresas_has_servicios', 'Servicios_idServicio', 'Empresas_idEmpresa')
					->withPivot('idEmpresas_has_Servicioscol', 'Costo_Servicio');
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'personas_has_servicios', 'Servicios_idServicio', 'Personas_idPersonas')
					->withPivot('id_Personas_has_Servicios', 'Costo_Servicio');
	}
}
