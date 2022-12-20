<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class TiempoMaximo implements Rule, DataAwareRule
{
    protected $data = [];
    private $diferencia;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    
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
        $fechaInicio = new DateTime($this->data["fechaInicio"]);
        $fechaFin = new DateTime($this->data["fechaFin"]);
        $diferencia = $fechaFin->diff($fechaInicio);
        return $diferencia->days <= 31*3;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La fecha máxima de proyecto es 3 meses';
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
