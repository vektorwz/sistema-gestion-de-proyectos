@extends('base')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/proyecto.css') }}">
@endpush

@section('contenido')
    @php $fechaCol = new DateTime($tabla->fechaInicio); @endphp
    {{-- Genero las columnas con las fechas en dias --}}
    <div class="container p-3">
        {{-- Info del proyecto --}}
        <div class="row m-1">
            <div class="col">
                <div class="row text-center">
                    <h2>{{ $proyecto->nombre}} </h2>
                </div>

                <div class="row">

                    <table class="table text-center">
                        <tr>
                            <td class="fecha-inicio">
                                Inicio:
                                @php
                                    $fecha = new DateTime($proyecto->fecha_inicio);
                                    echo ($fecha->format('d/m/Y'));
                                @endphp
                            </td>
                            <td class="fecha-final">
                                Fin:
                                @php
                                    $fecha = new DateTime($proyecto->fecha_final);
                                    echo ($fecha->format('d/m/Y'));
                                @endphp
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="row">

                    <div class="col-6 d-flex">

                        <form action = " {{ route('proyectos.destroy', $proyecto->id_proyecto) }} " method="POST" class="mx-auto my-2"
                            onsubmit="return confirm('Eliminar el proyecto también elimina sus tareas asociadas ¿Desea continuar?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger"type="submit">Eliminar proyecto</button>
                        </form>
                        
                    </div>
                    
                    <div class="col-6 d-flex">

                        <a id="editar" href="{{ route('proyectos.edit', $proyecto->id_proyecto ) }}" class="mx-auto my-2">
                            <button class="btn btn-warning">Editar proyecto</button>
                        </a>
                        
                    </div>
                </div>

            </div>
        </div>

        {{-- Tabla de Tareas --}}
        @if ($tabla->tareas)
            <div class="row m-1">
                <div class="col" style="overflow: auto">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                @for($i = 0; $i < $tabla->cantCols; $i++)
                                    
                                    <th style="border: 1px solid black; color: white;"> {{-- TEMPORAL --}}
                
                                        @php 
                                            echo($fechaCol->format("d M"));
                                            //guardo la fecha de la columna en un array
                                            array_push($tabla->nombreCols, $fechaCol->format("d M"));
                                            $fechaCol->add(new DateInterval("P1D"));
                                        @endphp
                                    
                                    </th>
                                @endfor
                            </tr>
                            
                        </thead>
                        
                        <tbody>
                        {{-- Por cada tarea genero una fila, tarea es un obj con campos relacionados a la tarea --}}
                        @foreach ($tabla->tareas as $tarea)
                            
                                {{-- Utilizo un objeto DateTime para manipular las fechas y poder sumarle un dia a cada fecha en cada ciclo --}}
                                @php $fechaAct = new DateTime($tarea->fechaInicio); @endphp
                                <tr style='border: 1px solid black'>
                
                                    @for($i = 0; $i < $tabla->cantCols; $i++)
                                        <td style='border: 1px solid black; text-align: center'>

                                        @if($fechaAct->format('d M') == $tabla->nombreCols[$i] && $tarea->nombreFin != $tabla->nombreCols[$i])
                                            <a style="width: 20px; height: 20px" href="{{ route('tareas.show', $tarea->id) }}">{{ $tarea->nombreTarea }}</a>
                                            @php $fechaAct->add(new DateInterval("P1D")) @endphp
                                        @endif

                                        @if ($tarea->nombreFin == $tabla->nombreCols[$i])
                                            <a style="width: 20px; height: 20px" href="{{ route('tareas.show', $tarea->id) }}">{{ $tarea->nombreTarea }}</a>
                                        @endif
                                        
                                        </td>
                                    @endfor
                
                                </tr>        
                
                        @endforeach
                
                        </tbody>
                
                    </table>
                </div>
            </div>      
        @else
            <div class="container">
                <div class="row m-1">
                    <div class="col text-center">
                        <h2>El proyecto no tiene tareas</h2>
                    </div>
                </div>
            </div>
        @endif


        {{-- Acciones --}}
        <div class="row m-1">
            <div class="col d-flex">

                <a id="agregarTarea" href="{{ route('tareas.create', $proyecto->id_proyecto) }}" class="mx-auto">
                    <button class="btn btn-success">Agregar una tarea al proyecto</button>
                </a>

            </div>
        </div>
    </div>
    
@endsection