<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Genero
 * 
 * @property int $idGénero
 * @property string $Nombre_Género
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Genero extends Model
{
	protected $table = 'generos';
	protected $primaryKey = 'idGénero';
	public $timestamps = false;

	protected $fillable = [
		'Nombre_Género'
	];

	public function personas()
	{
		return $this->hasMany(Persona::class, 'Generos_idGénero');
	}
}
