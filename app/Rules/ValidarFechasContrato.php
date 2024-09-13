<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ValidarFechasContrato implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return string $fail
     */

    public function passes($attribute, $value)
    {
        $fail = null;
        // Desempaquetamos los valores de inicio y fin (asumiendo que vienen en un array)
        [$fecha_inicio, $fecha_fin] = explode(',', $value);

        // Validaciones básicas
        if (!Carbon::parse($fecha_inicio) || !Carbon::parse($fecha_fin)) {
            $fail('Las fechas no son válidas.');
            return false;
        }

        // Validar que la fecha de inicio sea anterior a la fecha de fin
        if (Carbon::parse($fecha_inicio)->greaterThanOrEqualTo(Carbon::parse($fecha_fin))) {
            $fail('La fecha de inicio debe ser anterior a la fecha de fin.');
            return false;
        }

        // Validaciones adicionales (ej: no permitir contratos en el pasado)
        if (Carbon::parse($fecha_inicio)->lessThan(now())) {
            $fail('La fecha de inicio no puede ser en el pasado.');
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'Las fechas de inicio y fin del contrato no son válidas.';
    }
}
