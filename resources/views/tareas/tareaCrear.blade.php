@extends('base')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/proyectoForm.css') }}">
@endpush

@section('contenido')
    <div class="container p-2">
        <div class="row">
            <div class="col">

                <form action=" {{ route('tareas.store') }} " method="post" onsubmit="return confirm('¿Desea continuar?')" class="form-control-lg">
                    @csrf
                    <div class="row my-2">
                        <label for="nombre" class="form-label">Nombre</label>

                        <input type="text" name="nombre" id="nombre" value="{{ old("nombre") }}" autocomplete="off"
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

                    </div>
            
                    <input type="hidden" name="realizado" value="0">
                    
                    <div class="row my-2">
                        <div class="col-6">
                            
                            <label for="fechaInicio" class="form-label">Fecha de inicio</label>

                            <input type="date" name="fechaInicio" id="fechaInicio" min="{{ $proyecto->fecha_inicio }}"
                                max="{{ $proyecto->fecha_final}}"
                                @class(['error-input' => $errors->has('fechaInicio')])

                                @if(old("fechaInicio")!== null)
                                    value="{{ old("fechaInicio") }}"
                                @else
                                    value="{{ $proyecto->fecha_inicio }}"
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
                        <div class="col-6">

                            <label for="fechaFin" class="form-label">Fecha de fin</label>

                            <input type="date" name="fechaFin" id="fechaFin" min="{{ $proyecto->fecha_inicio }}" 
                            max="{{ $proyecto->fecha_final}}"
                            @class(['error-input' => $errors->has('fechaFin')])

                            @if(old("fechaFin")!== null)
                                value="{{ old("fechaFin") }}"
                            @else
                                value="{{ $proyecto->fecha_final }}"
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

                    <div class="row my-2">
                        <label for="desc">Descripción</label>

                        <textarea type="text" name="desc" id="desc" autocomplete="off" class="form-control"
                        cols="10" rows="2" maxlength="255">@if(old('desc')){{ old('desc') }}@endif</textarea>

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
                            
                    <input type="hidden" name="proyectoFK" id="proyectoFK" value="{{ $proyecto->id_proyecto }}">

                    <div class="row my-2">
                        <button type="submit" class="btn btn-primario">Crear Nueva Tarea</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection