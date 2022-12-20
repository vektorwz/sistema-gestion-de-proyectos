var inputNombre = document.querySelector("input#nombre");
var inputNombreModificado = document.querySelector("input#nombreModificado");
inputNombre.addEventListener("click", e =>{
    inputNombreModificado.value = true;
});
console.log(inputNombre);