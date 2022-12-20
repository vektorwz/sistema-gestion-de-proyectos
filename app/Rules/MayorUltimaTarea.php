<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;

class MayorUltimaTarea implements Rule
{
    private $ultimaFecha;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tabla)
    {
        $this->ultimaFecha = new DateTime($tabla->fechaUltimaTarea);
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
        return $fechaAct >= $this->ultimaFecha;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $diff = $this->ultimaFecha->diff(new DateTime());
        if ($diff->format('%d') === "0"){
            return 'La fecha final es menor ó igual a la actual';
        } else {
            return 'La fecha final modificada es menor que la ultima tarea del proyecto, revise las fechas de sus tareas';
        }
    }
}
