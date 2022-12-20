@extends('base')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/proyectoForm.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/cambioNombre.js') }}"></script>
@endpush

@section('contenido')
    {{-- --------------------------------- --}}
    <div class="container p-3">

        <form action=" {{ route('tareas.update', $tarea->id_tarea) }} " method="POST" onsubmit="return confirm('¿Desea continuar?')"
            class="form-control-lg">
            @method('PUT')
            @csrf

            <div class="row justify-content-center my-3">
                <div class="col-auto text-center">

                    <label for="nombre" class="form-label">Nombre</label>
            
                    <input type="text" name="nombre" id="nombre" value="{{ $tarea->nombre }}" autocomplete="off"
                    @class(['error-input' => $errors->has('nombre')]) maxlength="32"
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
                        <div class="form-text">
                            El nombre debe tener entre 1-32 carácteres de máximo
                        </div>
                    @endif

                    {{-- Input para registrar si se intentó cambiar el nombre --}}
                    <input type="hidden" name="nombreModificado" id="nombreModificado" value="">

                </div>

                <div class="col-auto text-center">
                    <label for="realizado" class="form-label">Realizado</label>
                    <input type="checkbox" name="realizado">
                </div>
            </div>

            <div class="row my-3 text-center">
                <div class="col-7">
                    <div class="row">

                        <label for="desc" class="form-label">
                            <h4>Descripción</h4>                        
                        </label>

                    </div>

                    <textarea type="text" name="desc" id="desc" autocomplete="off" 
                    cols="30" rows="6" maxlength="254">@if(old('desc')){{old('desc')}}@else{{$tarea->observaciones}}@endif</textarea>
                    
        
                    @if ($errors->has('desc'))
                        <div class="form-text">
                            <ul class="error-lista">
        
                                @foreach ($errors->get('desc') as $mensaje)
                                    <li>{{ $mensaje }}</li>
                                @endforeach
        
                            </ul>
                        </div>
                    @endif

                </div>

                <div class="col-5 d-flex flex-column justify-content-around align-items-center">

                    <div class="row">

                        <label for="fechaInicio" class="form-label">Fecha de inicio</label>
            
                        <input type="date" name="fechaInicio" id="fechaInicio" min="{{ $proyecto->fecha_inicio }}" class="form-control"
                            max="{{ $proyecto->fecha_final}}"
                            @class(['error-input' => $errors->has('fechaInicio')])
        
                            @if(old("fechaInicio")!== null)
                                value="{{ old("fechaInicio") }}"
                            @else
                                value="{{ $tarea->fecha_inicio }}"
                            @endif
                        >
        
                        @if ($errors->has('fechaInicio'))
                            <div class="form-text">
                                <ul class="error-lista">
        
                                    @foreach ($errors->get('fechaInicio') as $mensaje)
                                        <li>{{ $mensaje }}</li>
                                    @endforeach
        
                                </ul>
                            </div>
                        @endif

                    </div>

                    <div class="row">
                        <label for="fechaFin" class="form-label">Fecha de fin</label>
            
                        <input type="date" name="fechaFin" id="fechaFin" min="{{ $proyecto->fecha_inicio }}" class="form-control"
                        max="{{ $proyecto->fecha_final}}"
                        @class(['error-input' => $errors->has('fechaFin')])
        
                        @if(old("fechaFin")!== null)
                            value="{{ old("fechaFin") }}"
                        @else
                            value="{{ $tarea->fecha_final }}"
                        @endif
                        >
        
                        @if ($errors->has('fechaFin'))
                            <div class="form-text">
                                <ul class="error-lista">
        
                                    @foreach ($errors->get('fechaFin') as $mensaje)
                                        <li>{{ $mensaje }}</li>
                                    @endforeach
        
                                </ul>
                            </div>
                        @endif

                    </div>

                </div>

            <div class="row my-3">
                <button type="submit" class="btn btn-primario">Editar Tarea</button>
            </div>
        </form>

    </div>
    

@endsection