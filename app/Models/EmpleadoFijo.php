<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoFijo extends Model
{
    use HasFactory;

    // La tabla asociada al modelo
    protected $table = 'empleado_fijos';

    // La clave primaria de la tabla
    protected $primaryKey = 'id';

    // Los atributos que son asignables en masa
    protected $fillable = [
        'personas_id',
        'cargos_id',
        'turnos_id',
        'fecha_solicitud',
        'status_solicitud',
    ];

    // Si tu tabla no usa los timestamps
    public $timestamps = true;

    // Relación con la tabla Personas
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'personas_id', 'idPersonas');
    }

    // Relación con la tabla Cargos
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargos_id', 'idCargos');
    }

    // Relación con la tabla Turnos
    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turnos_id', 'idTurnos');
    }
}
