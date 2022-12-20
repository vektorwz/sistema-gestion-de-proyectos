<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;

class MenorPrimeraTarea implements Rule
{
    private $primeraFecha;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tabla)
    {
        $this->primeraFecha = new DateTime($tabla->fechaPrimeraTarea);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $fechaAct = new DateTime($value);
        return $fechaAct <= $this->primeraFecha;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La fecha de inicio modificada es mayor que la primera tarea del proyecto, revise las fechas de sus tareas';
    }
}
