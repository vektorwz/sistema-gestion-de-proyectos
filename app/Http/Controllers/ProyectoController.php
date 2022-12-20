<?php
namespace App\Http\Controllers;

use App\Models\Entities\Tabla;
use App\Rules\MayorUltimaTarea;
use App\Rules\MenorFechaInicio;
use App\Rules\MenorPrimeraTarea;
use App\Rules\TiempoMaximo;
use App\Rules\Unico;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = traerRecursos('proyecto');
        if (!$proyectos) {
            return view('proyectos/sinProyectos');
        } else {
            return view('proyectos/proyectos', [
                "proyectos" => $proyectos
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyectos/proyectoCrear');
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
                new Unico("proyecto")
            ],
            "fechaInicio" => "required|date",
            "fechaFin" => [
                "required",
                "date",
                new MenorFechaInicio,
                new TiempoMaximo
            ]
        ]);

        try {
            altaProyecto($request);
            return redirect (route('proyectos.index'));
        } catch (\Throwable $th) {
            //throw $th;
        }           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto = traerRecurso('proyecto', $id);
        $tabla = new Tabla($proyecto);
        return view('proyectos/proyecto', [
            "proyecto" => $proyecto,
            "tabla" => $tabla
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
        $proyecto = traerRecurso('proyecto', $id);
        return view('proyectos/proyectoEditar', [
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
        $proyecto = traerRecurso('proyecto', $id);
        $tabla = new Tabla($proyecto);
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
                new Unico("proyecto")
            ],
            "fechaInicio" => [
                "required",
                "date",
                new MenorPrimeraTarea($tabla)
            ],
            "fechaFin" => [
                "required",
                "date", 
                new MayorUltimaTarea($tabla), 
                new MenorFechaInicio,
                new TiempoMaximo
            ]
        ]);
        
        actProyecto($request, $id);
        return redirect()->route('proyectos.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        eliminarFk('tarea', 'proyecto', $id);
        eliminarRecurso('proyecto', $id);
        return redirect('proyectos');
    }
}
