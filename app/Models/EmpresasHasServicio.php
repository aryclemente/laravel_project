<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpresasHasServicio
 *
 * @property int $idEmpresas_has_Servicioscol
 * @property float|null $Costo_Servicio
 * @property int $Empresas_idEmpresa
 * @property int $Servicios_idServicio
 *
 * @property Empresa $empresa
 * @property Servicio $servicio
 * @property Collection|SolicitudesContrato[] $solicitudes_contratos
 *
 * @package App\Models
 */
class EmpresasHasServicio extends Model
{
	protected $table = 'empresas_has_servicios';
	public $timestamps = false;

	protected $casts = [
		'Costo_Servicio' => 'float',
		'Empresas_idEmpresa' => 'int',
		'Servicios_idServicio' => 'int'
	];

	protected $fillable = [
		'Costo_Servicio'
	];

	public function empresa()
	{
		return $this->belongsTo(Empresa::class, 'Empresas_idEmpresa');
	}

	public function servicio()
	{
		return $this->belongsTo(Servicio::class, 'Servicios_idServicio');
	}

	public function solicitudes_contratos()
	{
		return $this->hasMany(SolicitudesContrato::class, 'Empresas_has_Servicios_idEmpresas_has_Servicioscol');
	}
}
