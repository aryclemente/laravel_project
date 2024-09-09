<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoSolicitud
 *
 * @property int $idTipo_Solicitud
 * @property string|null $Tipo_Solicitud
 *
 * @property Collection|SolicitudesContrato[] $solicitudes_contratos
 *
 * @package App\Models
 */
class TipoSolicitud extends Model
{
	protected $table = 'tipo_solicitud';
	protected $primaryKey = 'idTipo_Solicitud';
	public $timestamps = false;

	protected $fillable = [
		'Tipo_Solicitud'
	];

	public function solicitudes_contratos()
	{
		return $this->hasMany(SolicitudesContrato::class, 'Tipo_Solicitud_idTipo_Solicitud');
	}
}
