<?php

namespace App\Models\Entities;

use DateTime;
use Illuminate\Support\Facades\DB;

class Tarea extends Tabla{
    public $nombreTarea;
    public $nombreInicio;
    public $nombreFin;

    function __construct($tarea)
    {
        $this->nombreTarea = $tarea->nombre;
        $this->id = $tarea->id_tarea;
        $this->fechaInicio = $tarea->fecha_inicio;
        $this->fechaFin = $tarea->fecha_final;
        $this->cantCols = $this->setCantCols($tarea);
        $aux = new DateTime($tarea->fecha_inicio);
        $this->nombreInicio = $aux->format("d M");
        $aux = new DateTime($tarea->fecha_final);
        $this->nombreFin = $aux->format("d M");
    }

    protected function setCantCols($tarea){
        $query = "SELECT datediff(fecha_final, fecha_inicio)+1 AS dias FROM tarea WHERE id_tarea = ?";
        $cantCols = DB::selectOne($query, [
            $tarea->id_tarea
        ]);
        return $cantCols->dias;
    }

}
