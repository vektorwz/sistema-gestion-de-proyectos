<?php

namespace App\Http\Controllers;

use App\Rules\MenorFechaInicio;
use App\Rules\Unico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{
    public function ordenarTareas($clave, $orden){
        $tareasOrdenadas = DB::select("SELECT * FROM tarea ORDER BY {$clave} {$orden}");
        return $tareasOrdenadas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clave = null, $orden = null)
    {
        $tareas = traerRecursos('tarea');
        if ($clave == null && $orden == null){
            /* Ordenamiento por defecto es por clave de proyecto, osea, por fecha de creacion descendente */
            uasort($tareas, function ($a, $b) {
                if ($a == $b){
                    return 0;
                }
                return ($a->proyecto_fk < $b->proyecto_fk) ? -1 : 1;
            });
            return view('tareas/tareas', [
                "tareas" => $tareas
            ]);
        } else {
            $tareasOrdenadas = $this->ordenarTareas($clave, $orden);
            return view('tareas/tareas', [
                "tareas" => $tareasOrdenadas
            ]);
            
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idProyecto) 
    {
        $proyecto = traerRecurso('proyecto', $idProyecto);
        return view('tareas/tareaCrear', [
            "proyecto" => $proyecto
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => [
                "required",
                "max:32",
                new Unico("tarea")
            ],
            "fechaInicio" => [
               "required",
               "date" 
            ],
            "fechaFin" => [
                "required",
                "date",
                new MenorFechaInicio
            ],
            "desc" => [
                "required",
                "max:255"
            ]
        ]);
        altaTarea($request);
        return redirect()->route('proyectos.show', [$request->input("proyectoFK")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarea = traerRecurso('tarea', $id);
        return view('tareas/tarea', [
            "tarea" => $tarea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea = traerRecurso('tarea', $id);
        $proyecto = traerRecurso('proyecto', $tarea->proyecto_fk);
        return view('tareas/tareaEditar', [
            "tarea" => $tarea,
            "proyecto" => $proyecto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input("nombreModificado") === "true"){
            $request->merge(["nombreModificado" => true]);
        } else {
            $request->merge(["nombreModificado" => false]);
        }
        $request->validate([
            "nombre" => [
                "required",
                "max:32",
                "exclude_if:nombreModificado,==,false",
                new Unico("tarea")
            ],
            "fechaInicio" => [
               "required",
               "date" 
            ],
            "fechaFin" => [
                "required",
                "date",
                new MenorFechaInicio
            ],
            "desc" => [
                "max:254"
            ]
        ]);
        actTarea($request, $id);
        return redirect()->route('tareas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            eliminarRecurso('tarea', $id);
            return redirect()->route('tareas.index');
        } catch (\Throwable $th) {
        }
        
    }
}
