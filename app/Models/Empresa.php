<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
 * 
 * @property int $idEmpresa
 * @property string $Nombre_Empresa
 * @property int $RIF
 * @property string $Dirección
 * @property string $Teléfono
 * @property int $Status_idStatus
 * 
 * @property Collection|Servicio[] $servicios
 *
 * @package App\Models
 */
class Empresa extends Model
{
	protected $table = 'empresas';
	protected $primaryKey = 'idEmpresa';
	public $timestamps = false;

	protected $casts = [
		'RIF' => 'int',
		'Status_idStatus' => 'int'
	];

	protected $fillable = [
		'Nombre_Empresa',
		'RIF',
		'Dirección',
		'Teléfono',
		'Status_idStatus'
	];

	public function servicios()
	{
		return $this->belongsToMany(Servicio::class, 'empresas_has_servicios', 'Empresas_idEmpresa', 'Servicios_idServicio')
					->withPivot('idEmpresas_has_Servicioscol', 'Costo_Servicio');
	}
}
