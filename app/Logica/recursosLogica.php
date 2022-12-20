<?php
use Illuminate\Support\Facades\DB;

//Devuelve todos los recursos de una tabla
function traerRecursos($tabla){
    return DB::select("SELECT * FROM {$tabla}");
}

//Devuelve un recurso por id
function traerRecurso($tabla, $id){
    //trae los nombres de las cols mediante la information schema => informacion meta de la BD
    //columnas es un array de objetos
    $columnas = DB::select(
            "SELECT `COLUMN_NAME` 
            FROM `INFORMATION_SCHEMA`.`COLUMNS` 
            WHERE `TABLE_SCHEMA`='sistema-gestion-proyectos' 
            AND `TABLE_NAME`='{$tabla}'"
        );
    return DB::selectOne("SELECT * FROM {$tabla} WHERE {$columnas[0]->COLUMN_NAME} = ?", [$id]);
}

//Elimina un recurso por id
function eliminarRecurso($tabla, $id){
    //$columnas es un vector con todas las cols de la tabla, la primera posicion es el id
    $columnas = DB::select(
        "SELECT `COLUMN_NAME` 
        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
        WHERE `TABLE_SCHEMA`='sistema-gestion-proyectos' 
        AND `TABLE_NAME`='{$tabla}'"
    );
    return DB::delete("DELETE FROM {$tabla} WHERE {$columnas[0]->COLUMN_NAME} = ?", [$id]);
}

//Elimina todas fk de un recurso
/**
 * $tabla => la tabla que contiene las fk
 * $tablaRef => La tabla a las que las fk hacen referencia
 * $id  => id de la fk
 * $nombre_cols => nombre de las columnas que contienen fk
 */
function eliminarFk($tabla, $tablaRef, $id) {
    $nombreCols = DB::select(
        "SELECT
            COLUMN_NAME
        FROM
            INFORMATION_SCHEMA.KEY_COLUMN_USAGE
        WHERE
            REFERENCED_TABLE_SCHEMA = 'sistema-gestion-proyectos' AND
            REFERENCED_TABLE_NAME = ? AND
            TABLE_NAME = ?;", [
                $tablaRef,
                $tabla
            ]);
    return DB::delete("DELETE FROM {$tabla} WHERE {$nombreCols[0]->COLUMN_NAME} = ?", [$id]);    
}

//Linkea fk's con su respectiva referencia
function traerReferenciaFk($tabla, $tablaFk, $fk){
    return DB::selectOne(
        "SELECT 
            {$tabla}.nombre
        FROM 
            ({$tabla} INNER JOIN {$tablaFk} ON {$tabla}.id_{$tabla} = {$tablaFk}.{$tabla}_fk) 
        WHERE
            {$tabla}_fk = ?
        GROUP BY 
            {$tabla}.nombre;",[
            $fk
            ]
    );
}