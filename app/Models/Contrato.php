<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrato
 *
 * @property int $idContratos
 * @property Carbon $Fecha_Inicio
 * @property Carbon $Fecha_Fin
 * @property float $Remuneración
 * @property bool $Status_Contrato
 * @property int $Solicitudes_contratos_idSolicitud
 *
 * @property SolicitudesContrato $solicitudes_contrato
 *
 * @package App\Models
 */
class Contrato extends Model
{
	protected $table = 'contratos';
	public $timestamps = false;
	protected $primaryKey = 'idContratos';

	protected $casts = [

		'Fecha_Inicio' => 'datetime',
		'Fecha_Fin' => 'datetime',
		'Remuneración' => 'float',
		'Status_Contrato' => 'bool',
		'Solicitudes_contratos_idSolicitud' => 'int',
		'Cargos_idCargos' => 'int',
		'Cargos_Turnos_idTurnos' => 'int'
	];

	protected $fillable = [
		'Fecha_Inicio',
		'Fecha_Fin',
		'Remuneración',
		'Status_Contrato',
		'Solicitudes_contratos_idSolicitud'
	];



	public function solicitudes_contrato()
	{
		return $this->belongsTo(SolicitudesContrato::class, 'Solicitudes_contratos_idSolicitud');
	}
}
