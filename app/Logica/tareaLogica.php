<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//Da de alta una tarea
function altaTarea(Request $request){
    $tarea = $request->input();
    DB::transaction(function () use ($tarea){
        DB::insert("INSERT INTO tarea (nombre, realizado, fecha_inicio, fecha_final, observaciones, proyecto_fk) 
            VALUES (?, ?, ?, ?, ?, ?)", [
                $tarea["nombre"],
                $tarea["realizado"],
                $tarea["fechaInicio"],
                $tarea["fechaFin"],
                $tarea["desc"],
                $tarea["proyectoFK"]
            ]);
    });
}

//Actualiza una tarea
function actTarea(Request $request, $id){
    $tarea = $request->input();
    if(isset($tarea["realizado"]))
        $tarea["realizado"] = true;
    else
        $tarea["realizado"] = false;
    DB::transaction(function () use ($tarea, $id){
        DB::update("UPDATE tarea SET nombre = ?, realizado = ?, fecha_inicio = ?, fecha_final = ?, observaciones = ?
        WHERE id_tarea = {$id};" ,[
            $tarea["nombre"],
            $tarea["realizado"],
            $tarea["fechaInicio"],
            $tarea["fechaFin"],
            $tarea["desc"]
        ]);
    });
}
?>