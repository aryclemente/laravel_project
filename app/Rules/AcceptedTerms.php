<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AcceptedTerms implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value === '1' || $value === 'on'; // Ajusta según tu implementación
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Debe aceptar los términos y condiciones.';
    }
}
