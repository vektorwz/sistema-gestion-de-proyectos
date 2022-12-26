<?php
namespace App\Models\Entities;

use DateTime;
use DateTimeZone;

class Estadisticas {
    public $contTareas = 0;
    public $contTareasRealizadas = 0;
    public $contTareasPendientes = 0;
    public $contProyectos = 0;
    public $porcTareasPendientes = 0;
    public $porcTareasRealizadas = 0;
    public $proyectosTarde = [];
    public $proyectosFinalizados = [];
    private $timezone;

    public function __construct($proyectos, $tareas){
        $this->timezone = new DateTimeZone('America/Argentina/Buenos_Aires');
        foreach ($proyectos as $proyecto) {
            $fechaFinal = new DateTime($proyecto->fecha_final, $this->timezone);
            $diferencia = $fechaFinal->diff(new DateTime('now', $this->timezone));
            $diferencia->days < 7 ? array_push($this->proyectosTarde, $proyecto) : "" ;
            $diferencia->days < 0 ? array_push($this->proyectosFinalizados, $proyecto) : "" ;
            $this->contProyectos++;
        }
        foreach ($tareas as $tarea) {
            $tarea->realizado ? $this->contTareasRealizadas++ : $this->contTareasPendientes++;
            $this->contTareas++;
        }
        $this->contTareas != 0 ?
            $this->porcTareasPendientes = $this->contTareasPendientes/$this->contTareas : "";
        $this->contTareas != 0 ? 
            $this->porcTareasRealizadas = $this->contTareasRealizadas/$this->contTareas : "";
    }
}