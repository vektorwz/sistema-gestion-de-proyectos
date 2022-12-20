@extends('base')

@push('scripts')
    <script src="{{ asset("js/buscadorTarea.js") }}"></script>
@endpush

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/tareas.css') }}">
@endpush

@section('contenido')

    <div class="container p-3">
        <div class="row text-center">
            <h2>Tareas</h2>
        </div>
        <div class="col">
            {{-- Filtros --}}
            <div class="row my-2 text-center">
                <div class="col d-flex justify-content-center align-items-center">

                    <label for="buscar" class="mx-2" id="buscador">Buscar</label>
                    <input type="search" name="buscar" id="barra-busqueda" class="my-3" autocomplete="off">

                </div>

                <div class="col">
                    <div class="row text-center">
                        <h4>Ordenar Tareas Por:</h4>
                    </div>

                    <div class="row justify-content-evenly">

                        <div class="col">

                            <div class="dropdown">
                                <button class="btn btn-primario dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Fecha Inicio
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('tareas.index', ['clave' => 'fecha_inicio', 'orden' => 'DESC']) }}">Descendente</a></li>
                                    <li><a class="dropdown-item" href="{{ route('tareas.index', ['clave' => 'fecha_inicio', 'orden' => 'ASC']) }}">Ascendente</a></li>            
                                </ul>
                            </div>

                        </div>

                        <div class="col">

                            <div class="dropdown">
                                <button class="btn btn-primario dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Fecha Fin
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('tareas.index', ['clave' => 'fecha_final', 'orden' => 'DESC']) }}">Descendente</a></li>
                                    <li><a class="dropdown-item" href="{{ route('tareas.index', ['clave' => 'fecha_final', 'orden' => 'ASC']) }}">Ascendente</a></li>            
                                </ul>
                            </div>

                        </div>

                        <div class="col">

                            <div class="dropdown">
                                <button class="btn btn-primario dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Nombre Tarea
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('tareas.index', ['clave' => 'nombre', 'orden' => 'ASC']) }}">Ascendente</a></li>
                                <li><a class="dropdown-item" href="{{ route('tareas.index', ['clave' => 'nombre', 'orden' => 'DESC']) }}">Descendente</a></li>    
                                </ul>
                            </div>
                            
                        </div>

                        <div class="col">

                            <div class="dropdown">
                                <button class="btn btn-primario dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Fecha Creación
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('tareas.index', ['clave' => 'proyecto_fk', 'orden' => 'ASC']) }}">Ascendente</a></li>
                                <li><a class="dropdown-item" href="{{ route('tareas.index', ['clave' => 'proyecto_fk', 'orden' => 'DESC']) }}">Descendente</a></li>    
                                </ul>
                            </div>
                            
                        </div>

                    </div>

                </div>
            </div>

            {{-- Tareas --}}
            <div class="container">   
                <div class="row">
        
                    <div class="accordion" id="accordion">
                        @php $index = 'a'; @endphp
                        @foreach ($tareas as $tarea)
                            {{-- Cada Tarea --}}
                            <div class="accordion-item">

                                <h3 class="accordion-header" id="heading{{$index}}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{$index}}">
                                        <div class="info-tarea">
                                            <div class="nombre-proyecto">
                                                <strong>
                                                    @php echo(traerReferenciaFk('proyecto', 'tarea', $tarea->proyecto_fk)->nombre) @endphp
                                                </strong>
                                            </div>
                                            <div class="nombre-tarea">{{ $tarea->nombre }}</div>
                                        </div>                                
                                    </button>
                                </h3>

                                <div id="{{$index}}" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                    <div class="accordion-body">

                                        <div class="row">

                                            {{-- Información relacionada --}}
                                            <div class="col text-center">
                                                @if ($tarea->realizado)
                                                    <i class="bi bi-check-circle" style="color: white; font-size: 1.5rem;"></i>
                                                    <div class="realizado">Tarea Realizada</div>
                                                @else
                                                    <i class="bi bi-stopwatch" style="color: white; font-size: 1.5rem"></i>
                                                    <div class="realizado">Tarea Pendiente</div>
                                                    
                                                @endif
                                            </div>

                                            <div class="col text-center">
                                                <h5>Fecha Inicio:</h5>
                                                <div class="fecha-inicio" style="color: white">
                                                    @php
                                                        $fecha = new DateTime($tarea->fecha_inicio);
                                                        echo ($fecha->format('d/m/Y'));
                                                    @endphp
                                                </div>
                                            </div>

                                            <div class="col text-center">
                                                <h5>Fecha Final:</h5>
                                                <div class="fecha-inicio" style="color: white">
                                                    @php
                                                        $fecha = new DateTime($tarea->fecha_final);
                                                        echo ($fecha->format('d/m/Y'));
                                                    @endphp
                                                </div>
                                            </div>

                                            <div class="col accesos-rapidos">
                                                <div class="row">
                                                    
                                                    <div class="col">
                                                        <button class="btn btn-info">
                                                            <a href="{{ route("tareas.show", $tarea->id_tarea)}}">Más Detalle</a>
                                                        </button>
                                                    </div>

                                                    <div class="col">
                                                        <button class="btn btn-warning">
                                                            <a href="{{ route("tareas.edit", $tarea->id_tarea) }}">Editar Tarea</a>
                                                        </button>
                                                    </div>

                                                    <div class="col">
                                                        <form action="{{ route('tareas.destroy', $tarea->id_tarea)}}" method="post" onsubmit="return confirm('¿Desea continuar?')" 
                                                            class="boton-eliminar-tarea">
                                                            @method('DELETE')
                                                            @csrf
                                                        <button class="btn btn-danger">Eliminar Tarea</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                        @php $index++; @endphp             
                        @endforeach
                    </div>
        
                </div>
            </div>

        </div>
       
    </div>


@endsection