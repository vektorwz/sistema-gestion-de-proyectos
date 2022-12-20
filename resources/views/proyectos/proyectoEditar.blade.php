@extends('base')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/proyectoForm.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/cambioNombre.js') }}"></script>
@endpush

@section('contenido')
    <div class="container my-3">
        <div class="row">
            <div class="col">

                <form action=" {{ route('proyectos.update', $proyecto->id_proyecto) }} " method="POST" class="form-control-lg" 
                    onsubmit="return confirm('¿Desea continuar?')">
                    @method('PUT')
                    @csrf
                    <div class="row my-3">

                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value=" {{ $proyecto->nombre }}" autocomplete="off" maxlength="32"
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
                        
                        {{-- Input para registrar si se intentó cambiar el nombre --}}
                        <input type="hidden" name="nombreModificado" id="nombreModificado" value="">

                    </div>

                    <div class="row my-3 text-center">
                        <div class="col-6">

                            <label for="fechaInicio" class="form-label">Fecha de inicio</label>
                            <input type="date" name="fechaInicio" id="fechaInicio" value="{{ $proyecto->fecha_inicio }}"
                            @class(['error-input' => $errors->has('fechaInicio')])
                            >

                            @if ($errors->has('fechaInicio'))
                                <div class="form-text">
                                    <ul class="error-lista">

                                        @foreach ($errors->get('fechaInicio') as $mensaje)
                                            <li>{{$mensaje}}</li>
                                        @endforeach

                                    </ul>
                                </div>
                            @endif
                            
                        </div>

                        <div class="col-6">

                            <label for="fechaFin" class="form-label">Fecha de fin</label>
                            <input type="date" name="fechaFin" id="fechaFin" value="{{ $proyecto->fecha_final }}"
                            @class(['input-error' => $errors->has("fechaFin")])
                            >
                            
                            @if ($errors->has("fechaFin"))
                                <div class="form-text">
                                    <ul class="error-lista">

                                        @foreach ($errors->get('fechaFin') as $mensaje)
                                        <li>{{ $mensaje }} </li>
                                        @endforeach

                                    </ul>
                                </div>
                            @endif

                        </div>

                    </div>
                    <div class="row my-3">
                        <button type="submit" class="btn btn-success">Editar Proyecto</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
@endsection