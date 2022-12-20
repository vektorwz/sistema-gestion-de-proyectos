<div class="nav">

    <button class="btn btn-primario" type="button" data-bs-target="#offcanvas" data-bs-toggle="offcanvas">Menu</button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasLabel">Gestion de Proyectos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group">
                <a href="{{ route('proyectos.index') }}" class="list-group-item list-group-item-action" aria-current="true">
                    Proyectos
                </a>
                <a href="{{ route('tareas.index') }}" class="list-group-item list-group-item-action">
                    Tareas
                </a>
                <a href="{{ route('estadisticas') }}" class="list-group-item list-group-item-action">
                    Estadisticas
                </a>
            </div>
        </div>
    </div>

</div>
        