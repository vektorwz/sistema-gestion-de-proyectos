@extends('base')

@section('contenido')
<div class="container" id="contenedor-bienvenida">

    <div class="row">
        <div class="col text-center">
            <h2 id="titulo-bienvenida" class="my-4">
                ¡Todavía no hay proyectos creados!
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <p class="texto-bienvenida">
                Para crear tu próximo gran proyecto hace click en el boton.                   
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col text-center my-3">
            <a href="{{ route('proyectos.create') }}">
                <button class="btn btn-primario" id="comenzar-bienvenida">
                    Nuevo Proyecto
                </button>
            </a>
        </div>
    </div>

</div>
@endsection