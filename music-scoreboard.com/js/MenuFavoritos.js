async function cargarMenuFavoritosPlantilla (contenedorId) {

   
    let contenedor = document.getElementById(contenedorId);
    let idCancion = contenedor.id.split('menu_cancion_')[1];

    //elimina todos los menus de todas las canciones
    limpiarMenus(contenedor.querySelectorAll('.menu'));

    let temp = document.createElement('div');
    const response = await fetch("http://music-scoreboard.com/api/plantillas/favoritos-cancion?id=" + idCancion);
    temp.innerHTML = await response.text();

    let menu = temp.querySelector('.menu');
    menu.classList.add('oculto');
    contenedor.appendChild(menu);
    setTimeout(() => {menu.classList.remove('oculto')}, 100);

}

/**
 * Permite aplicar una puntuación de votación a una canción determinada meiante una llamada a la API REST
 * @param {*} puntuacion Puntuación de la canción
 * @param {*} id Id de la canción objetivo
 */
async function votarCancion (boton) {

    let contenedor = boton.closest('li');
    let favBoton = contenedor.querySelector('.fav-boton');
    let puntuacionSelect = contenedor.querySelector('.puntuacion-select').value;
    let puntuacionContenedor = contenedor.querySelector('.puntuacion-display-contenedor');
    let id = contenedor.id.split('menu_cancion_')[1];

    const formData = new FormData();
    formData.append("puntuacion", puntuacionSelect);
    formData.append("id", id);
    const response = await fetch("http://music-scoreboard.com/api/votar-cancion", {
        method: "POST",
        body: formData,
      });

    let json = await response.json();

    if (json.codigo !== 200) {
        alert(json.texto);
    } else {
        actualizarPuntuacion(id, puntuacionContenedor);
        favBoton.querySelector('img').src = "/img/iconos/fav.png";
        let menu = boton.closest('div.menu');
        menu.classList.add('oculto');
        setTimeout(() => {menu.innerHTML = "";}, 300);
    }

}

async function actualizarPuntuacion (id, puntuacionContenedor) {

    let puntuacionMediaElemento = puntuacionContenedor.querySelector('.puntuacion-cancion');
    let puntuacionTotalElemento = puntuacionContenedor.querySelector('.puntuacion-total-cancion');
    let numeroVotosElemento = puntuacionContenedor.querySelector('.numero-votos-cancion');

    //actualizar puntuacion
    const respuestaPuntuacion = await fetch("http://music-scoreboard.com/api/canciones/" + id);

    let jsonRespuestaPuntuacion = await respuestaPuntuacion.json();

    if (jsonRespuestaPuntuacion.codigo != 200) {
        alert(json.texto);
    } else {

        let cuerpo = jsonRespuestaPuntuacion.cuerpo;

        puntuacionMediaElemento.textContent = (Number(cuerpo.puntuacionTotal) / Number(cuerpo.numeroVotos)).toFixed(2);
        puntuacionTotalElemento.textContent = Number(cuerpo.puntuacionTotal).toFixed(0);
        numeroVotosElemento.textContent = Number(cuerpo.numeroVotos).toFixed(0);

    }

}

