@extends('base')

@section('contenido')
    <div class="container p-2">
        <div class="row my-3 text-center align-items-center">
            <div class="col">
                <h2>Estadisticas Generales</h2>
                <div class="progress" style="height: 1px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background-color: var(--grisOscuro);"></div>
                </div>
            </div>
        </div>
        <div class="row my-3 text-center">
            <div class="col">
                <div class="col">
                    <h4>Proyectos totales: {{ $estadisticas["contProyectos"] }}</h2>
                </div>
                
                <div class="progress" style="height: 1px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background-color: var(--grisOscuro);"></div>
                </div>
            </div>
        </div>

        <div class="row my-3 text-center align-items-center">
            <div class="col">
                <h4>Tareas totales: {{ $estadisticas["contTareas"] }}</h4>
            </div>

            <div class="vr"></div>

            <div class="col">
                <h4>Tareas Realizadas: {{ $estadisticas["contTareasRealizadas"]}}</h4>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ $estadisticas["porcTareasRealizadas"]*100 }}%">
                        {{ $estadisticas["contTareasRealizadas"] }}
                    </div>
                    <span class="mx-auto">{{ $estadisticas["contTareasPendientes"] }}</span>
                </div>
            </div>

            <div class="vr"></div>

            <div class="col">
                <h4>Tareas Pendientes: {{ $estadisticas["contTareasPendientes"] }}</h4>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width:{{ $estadisticas["porcTareasPendientes"]*100 }}%">
                        {{ $estadisticas["contTareasPendientes"] }}
                    </div>
                    <span class="mx-auto">{{ $estadisticas["contTareasRealizadas"] }}</span>
                </div>
            </div>
        </div>        
    </div>
@endsection