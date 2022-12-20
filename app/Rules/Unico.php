<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Unico implements Rule
{
    private $tabla;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tabla)
    {
        $this->tabla = $tabla;
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
        $buscar = function() use ($value){
            $resul = DB::selectOne("SELECT nombre FROM {$this->tabla} WHERE nombre = ?", [$value]);
            if(isset($resul))
                return $resul->nombre;
            else
                return false;
        };
        return $value !== $buscar();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El :attribute ya se encuentra registrado, porfavor elija otro.';
    }
}
