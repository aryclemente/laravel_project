<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SolicitudesContrato
 *
 * @property int $idSolicitud
 * @property Carbon $Fecha_solicitud
 * @property bool $Status_solicitud
 * @property int|null $Tipo_Solicitud_idTipo_Solicitud
 * @property int|null $id_Personas_has_Servicios_
 * @property int|null $Empresas_has_Servicios_idEmpresas_has_Servicioscol
 * @property int|null $id_Trabajador_id

 *
 * @property EmpresasHasServicio|null $empresas_has_servicio
 * @property PersonasHasServicio|null $personas_has_servicio
 * @property TipoSolicitud|null $tipo_solicitud
 * @property Trabajadores|null $id_Trabajador_id

 * @property Collection|Contrato[] $contratos
 *
 * @package App\Models
 */
class SolicitudesContrato extends Model
{

	protected $table = 'solicitudes_contratos';
	protected $primaryKey = 'idSolicitud';
	public $timestamps = false;
	protected $casts = [
		'Fecha_solicitud' => 'datetime',
		'Status_solicitud' => 'bool',
		'Tipo_Solicitud_idTipo_Solicitud' => 'int',
		'id_Personas_has_Servicios_' => 'int',
		'Empresas_has_Servicios_idEmpresas_has_Servicioscol' => 'int',
		'id_Trabajador_id ' => 'int'
	];

	protected $fillable = [
		'Fecha_solicitud',
		'Status_solicitud',
		'Tipo_Solicitud_idTipo_Solicitud',
		'id_Personas_has_Servicios_',
		'Empresas_has_Servicios_idEmpresas_has_Servicioscol',
		'id_Trabajador_id'
	];

	public function empresas_has_servicio()
	{
		return $this->belongsTo(EmpresasHasServicio::class, 'Empresas_has_Servicios_idEmpresas_has_Servicioscol');
	}

	public function personas_has_servicio()
	{
		return $this->belongsTo(PersonasHasServicio::class, 'id_Personas_has_Servicios_');
	}

	public function tipo_solicitud()
	{
		return $this->belongsTo(TipoSolicitud::class, 'Tipo_Solicitud_idTipo_Solicitud');
	}
	public function trabajadores()
	{
		return $this->belongsTo(Trabajadores::class, 'id_Trabajador_id');
	}

	public function contratos()
	{
		return $this->hasOne(Contrato::class, 'Solicitudes_contratos_idSolicitud');
	}
}
