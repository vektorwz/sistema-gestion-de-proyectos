<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class MenorFechaInicio implements InvokableRule, DataAwareRule
{
    protected $data = [];
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $fechaInicio = new DateTime($this->data["fechaInicio"]);
        $fechaFin = new DateTime($value);
        if ($fechaFin <= $fechaInicio){
            $fail("La fecha final es menor ó igual que la fecha inicial.");
        }
    }
    
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
