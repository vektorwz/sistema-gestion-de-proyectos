@extends('base')

@section('contenido')
<div class="container">
    <div class="col-auto">
        <form action="" method="post">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario">
            <br>
            <label for="contrasenia">Contraseña</label>
            <input type="text" name="contrasenia" id="contrasenia">
    
            <button type="submit">Enviar</button>
        </form>
    </div>
    

</div>
    
@endsection