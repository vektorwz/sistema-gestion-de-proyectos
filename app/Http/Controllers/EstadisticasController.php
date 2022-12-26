<?php

namespace App\Http\Controllers;

use App\Models\Entities\Estadisticas;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $proyectos = traerRecursos('proyecto');
        $tareas = traerRecursos('tarea');
        $estadisticas = new Estadisticas($proyectos, $tareas);
        $proyectosTarde = [];
        
        return view('estadisticas', [
            "estadisticas" => $estadisticas,
            "proyectos" => $proyectos,
            "proyectosTarde" => $proyectosTarde,
            "tareas" => $tareas
        ]);
    }
}
