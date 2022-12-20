@extends('base')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/proyectoForm.css') }}">    
@endpush

@section('contenido')

    <div class="container my-3">
        <div class="row">
            <div class="col">

                <form action=" {{ route('proyectos.store') }} " method="post" class="form-control-lg"
                onsubmit="return confirm('¿Desea continuar?');">
                @csrf
                    <div class="row my-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old("nombre") }}" required autocomplete="off" maxlength="32"
                        @class(['error-input' => $errors->has('nombre')])
                        >

                        @if ($errors->has('nombre'))
                            <div class="form-text">
                                <ul class="error-lista">

                                    @foreach ($errors->get('nombre') as $mensaje)
                                        <li>{{ $mensaje }}</li>
                                    @endforeach

                                </ul>
                            </div>
                        @else
                            <div class="form-text">El nombre debe tener entre 1-32 carácteres de máximo.</div>
                        @endif
                        
                    </div>

                    <div class="row text-center my-3">

                        <div class="col-6">

                            <label for="fechaInicio" class="form-label">Fecha de inicio</label>
                            <input type="date" name="fechaInicio" id="fechaInicio" value="{{ old("fechaInicio") }}" required
                            @class(['error-input' => $errors->has('fechaInicio')])
                            >
                            @if ($errors->has('fechaInicio'))
                                <div class="form-text">
                                    <ul class="error-lista">

                                        @foreach ($errors->get('fechaInicio') as $mensajes)
                                            <li>{{ $mensajes }}</li>
                                        @endforeach

                                    </ul>
                                </div>
                            @endif

                        </div>

                        <div class="col-6">

                            <label for="fechaFin" class="form-label">Fecha de fin</label>
                            <input type="date" name="fechaFin" id="fechaFin" value="{{ old("fechaFin") }}" required
                            @class(['error-input' => $errors->has('nombre')])
                            
                            >
                            @if ($errors->has('fechaFin'))
                                <div class="form-text">
                                    <ul class="error-lista">

                                        @foreach ($errors->get('fechaFin') as $mensaje)
                                            <li class="error-item">{{ $mensaje }}</li>
                                        @endforeach

                                    </ul>
                                </div>
                            @endif
                        </div>
                        
                    </div>

                    <div class="row my-3">
                        <button type="submit" class="btn btn-primario">Crear Nuevo Proyecto</button>
                    </div>

                </form>
            </div> {{-- FIN COL --}}
            
        </div> {{-- FIN ROW --}}
    </div> {{-- FIN CONTAINER --}}

    

@endsection

