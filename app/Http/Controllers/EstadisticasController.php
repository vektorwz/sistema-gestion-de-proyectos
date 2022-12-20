<?php

namespace App\Http\Controllers;

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
        $estadisticas = [];
        $contTareas = 0;
        $contTareasRealizadas = 0;
        $contTareasPendientes = 0;
        $contProyectos = 0;
        foreach ($proyectos as $proyecto) {
            $contProyectos++;
        }
        foreach ($tareas as $tarea) {
            $tarea->realizado ? $contTareasRealizadas++ : $contTareasPendientes++;
            $contTareas++;
        }
        $estadisticas = [
            "contTareas" => $contTareas,
            "contTareasRealizadas" => $contTareasRealizadas,
            "contTareasPendientes" => $contTareasPendientes,
            "contProyectos" => $contProyectos,
            "porcTareasPendientes" => $contTareas != 0 ? $contTareasPendientes/$contTareas : "",
            "porcTareasRealizadas" => $contTareas != 0 ? $contTareasRealizadas/$contTareas : ""
        ];

        return view('estadisticas', [
            "estadisticas" => $estadisticas,
            "proyectos" => $proyectos,
            "tareas" => $tareas
        ]);
    }
}
