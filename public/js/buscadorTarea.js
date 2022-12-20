function InicializarBarraBusqueda(){
    //Vars
    let tareas = document.querySelectorAll("div.accordion-item")
    let buscador = document.querySelector("#barra-busqueda");
    tareas.forEach(e => console.log(e));
    //Evento
    buscador.addEventListener("input", e => {
        let valor = e.target.value;
        tareas.forEach( tarea => {
            let nomProy = tarea.querySelector("div.nombre-proyecto").innerText.toLowerCase();
            let nomTarea = tarea.querySelector("div.nombre-tarea").innerText.toLowerCase();
            if (! (nomProy.includes(valor) || nomTarea.includes(valor)) ){
                tarea.style = "display: none";
            } else {
                tarea.style = "display: block";
            }
        });
    });
}

InicializarBarraBusqueda();