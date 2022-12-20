<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//Da de alta un proyecto
function altaProyecto(Request $request){
    $proyecto = $request->input();
    DB::transaction(function () use ($proyecto){
        DB::insert("INSERT INTO proyecto (nombre, fecha_inicio, fecha_final) VALUES (?, ?, ?)", [
            $proyecto["nombre"],
            $proyecto["fechaInicio"],
            $proyecto["fechaFin"]
        ]);
    });
}

//Actualiza un proyecto
function actProyecto (Request $request, $id){
    $proyecto = $request->input();
    DB::transaction(function () use ($proyecto, $id){
        DB::update("UPDATE proyecto SET nombre = ?, fecha_inicio = ?, fecha_final = ? WHERE id_proyecto = {$id};", [
            $proyecto["nombre"],
            $proyecto["fechaInicio"],
            $proyecto["fechaFin"]
        ]);
    });
}
?>