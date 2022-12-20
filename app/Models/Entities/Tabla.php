<?php
namespace App\Models\Entities;

use Illuminate\Support\Facades\DB;

class Tabla {
    public $id;
    public $fechaInicio;
    public $fechaFin;
    public $cantCols;
    private $cantFilas = 0;
    private $proxFila = 0;
    public $tareas = array();
    public $nombreCols = array();
    public $fechaPrimeraTarea = null;
    public $fechaUltimaTarea = null;

    public function __construct($proyecto)
    {
        $this->id = $proyecto->id_proyecto;
        $this->fechaInicio = $proyecto->fecha_inicio;
        $this->fechaFin = $proyecto->fecha_final;
        $this->cantCols = $this->setCantCols($proyecto);      
        $this->cantFilas = $this->setCantFilas($proyecto);
        $this->proxFila = $this->cantFilas+1;
        $this->tareas = $this->setTareas($proyecto);
        $this->fechaPrimeraTarea = $this->setPrimeraTarea();
        $this->fechaUltimaTarea = $this->setUltimaTarea();
    }

    protected function setCantCols($proyecto){
        $query = "SELECT datediff(fecha_final, fecha_inicio)+1 AS dias FROM proyecto WHERE id_proyecto = ?";
        $cantCols = DB::selectOne($query, [
            $proyecto->id_proyecto
        ]);
        return $cantCols->dias;
    }

    protected function setCantFilas($proyecto){
        $query = "SELECT count(*) AS cantTareas FROM (proyecto INNER JOIN tarea ON proyecto.id_proyecto = tarea.proyecto_fk) WHERE proyecto_fk = ?";
        $cantFilas = DB::selectOne($query, [
            $proyecto->id_proyecto
        ]);
        return $cantFilas->cantTareas;
    }

    protected function setTareas($proyecto){
        $query = "SELECT tarea.* FROM (proyecto INNER JOIN tarea ON proyecto.id_proyecto = tarea.proyecto_fk) WHERE proyecto_fk = ?";
        $tareasTabla = DB::select($query, [$proyecto->id_proyecto]);
        $tareasObj = array();
        foreach ($tareasTabla as $tarea) {
            $nuevaTarea = new Tarea($tarea);
            array_push($tareasObj, $nuevaTarea);
        }
        return $tareasObj;
    }
    
    protected function setPrimeraTarea(){
        return DB::selectOne("SELECT min(fecha_inicio) AS primera_fecha FROM tarea WHERE proyecto_fk = ?", [
            $this->id
        ])->primera_fecha;
    }

    protected function setUltimaTarea(){
        return DB::selectOne("SELECT max(fecha_final) AS ultima_fecha FROM tarea WHERE proyecto_fk = ?", [
            $this->id
        ])->ultima_fecha;
    }
}

?>