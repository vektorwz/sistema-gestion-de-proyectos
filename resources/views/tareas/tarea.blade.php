@extends('base')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/proyectos.css') }}">
@endpush

@section('contenido')

    <div class="container p-3">
        <div class="row justify-content-center my-3">
            <div class="col-auto text-center">

                <h2 class="d-inline">
                    {{ $tarea->nombre }}
                </h2>

            </div>

            <div class="col-auto text-center">

                @if ($tarea->realizado)
                    <i class="bi bi-check-circle" style="color: white; font-size: 1.5rem"></i>
                    <h5 style="display:inline">Realizado</h5>
                @else
                    <i class="bi bi-stopwatch" style="color: white; font-size: 1.5rem"></i>
                    <h5 style="display:inline">Pendiente</h5>
                @endif

            </div>

        </div>

        <div class="row my-3 text-center">
            
            <div class="col-7">
                <h4>Descripción</h4>
                <textarea name="desc" id="desc" cols="30" rows="6" disabled>{{$tarea->observaciones}}</textarea>
            </div>

            <div class="col-5 d-flex flex-column justify-content-around align-items-center">
                <div class="row">
                    <h4>Fecha de Inicio</h4>
                    <h5 class="">
                        @php
                            $fecha = new DateTime($tarea->fecha_inicio);
                            echo ($fecha->format('d/m/Y'));
                        @endphp
                    </h5>
                </div>
                <div class="row">
                    <h4>Fecha de Fin</h4>
                    <h5 class="">
                        @php
                            $fecha = new DateTime($tarea->fecha_final);
                            echo ($fecha->format('d/m/Y'));
                        @endphp
                    </h5>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-7 d-flex">

                <a href="{{ route('tareas.edit', $tarea->id_tarea) }}" class="mx-auto">
                    <button class="btn btn-warning">Editar Tarea</button>
                </a>

            </div>
            <div class="col-5 d-flex">
                
                <form action="{{ route('tareas.destroy', $tarea->id_tarea)}}" method="post" onsubmit="return confirm('¿Desea continuar?')"
                    class="mx-auto inline">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Eliminar Tarea</button>
                </form>

            </div>

        </div>
    </div>
    

@endsection