function cerrarMenu (boton) {
    let menu = boton.closest('.menu');
    menu.classList.add('oculto');
    setTimeout(() => {menu.innerHTML = ""; menu.remove()}, 300);
}

function limpiarMenus (contenedores) {
    for (let i = 0; i < contenedores.length; i++) {
        contenedores[i].remove();
    }
}