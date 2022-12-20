@extends('base')

@section('contenido')
    
    <div class="container">

        <div class="row">
            <div class="col text-center">
                <h2 id="titulo-bienvenida" class="my-4">
                    Bienvenido
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <p class="texto-bienvenida">
                    El proposito de esta aplicación web es facilitar la gestión de pequeños proyectos. <br>
                    Brindando una manera fácil y rápida de supervisar tus tareas.                    
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col text-center my-3">
                <a href="{{ route('proyectos.index') }}">
                    <button class="btn btn-primario" id="comenzar-bienvenida">
                        ¡Comenzar ahora!
                    </button>
                </a>
            </div>
        </div>

    </div>
@endsection