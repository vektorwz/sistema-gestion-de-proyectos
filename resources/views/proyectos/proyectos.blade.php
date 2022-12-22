@extends('base')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/proyecto.css') }}">    
@endpush

@section('contenido')
    
<div class="container p-3">
    
    <div class="row text-center">

        <div class="col d-flex justify-content-center m-3">

            
            <h2 class="mx-3">Crear</h2>
            
            <a href=" {{ route('proyectos.create') }}">
                <button class="btn btn-success">Nuevo Proyecto</button>
            <a>

        </div>
                    
    </div>

    @foreach ($proyectos as $proyecto)
        <div class="row my-3">
            <a href="{{ route('proyectos.show', $proyecto->id_proyecto) }}">
                <div class="col d-flex justify-content-center align-items-center contenedor-proyecto p-3">
                    
                    <div class="titulo mx-3">
                        <h4>{{ $proyecto->nombre }}</h2>
                    </div>
                                      
                    <div class="fecha-inicio mx-3">
                        @php
                            $timezone = new DateTimeZone('America/Argentina/Buenos_Aires');
                            $fecha = new DateTime($proyecto->fecha_inicio, $timezone);
                            echo ($fecha->format('d/m/Y'));
                        @endphp
                    </div>
                    
                    <span>-</span>
                    
                    <div class="fecha-final mx-3">
                        @php
                            $fecha = new DateTime($proyecto->fecha_final, $timezone);
                            echo ($fecha->format('d/m/Y'));
                        @endphp
                    </div>

                    <div class="vr"></div>

                    <div class="dias-faltantes ms-1">
                        @php
                            $fechaActual = new DateTime('now', $timezone);
                            $fechaFinal = new DateTime($proyecto->fecha_final, $timezone);
                            $diasFaltantes = $fechaFinal->diff($fechaActual);
                        @endphp
                        <strong>{{ $diasFaltantes->format('%d dias y %h horas') }}</strong> Faltantes
                    </div>
                        
                </div>
            </a>
        </div>
    @endforeach
            
</div>

@endsection
