

async function cargarMenuComentariosPlantilla(contenedorId, pagina, tipo) {

    let contenedor = document.getElementById(contenedorId);

    //elimina todos los menus de todas las canciones
    limpiarMenus(contenedor.querySelectorAll('.menu'));

    let id = contenedorId.split("menu_cancion_")[1];

    let temp = document.createElement('div');
    const response = await fetch(`http://music-scoreboard.com/api/plantillas/comentarios?id=${id}&pagina=${pagina}&tipo=${tipo}`);
    temp.innerHTML = await response.text();

    let menu = temp.querySelector('.menu');
    menu.classList.add('oculto');
    menu.classList.add('dinamico');
    contenedor.appendChild(menu);
    setTimeout(() => {menu.classList.remove('oculto')}, 100);

}

async function comentar(boton, tipo, id) {

    let menu = boton.closest('.menu');
    let comentario = boton.parentNode.querySelector('textarea').value;

    let formData = new FormData();
    formData.append('id', id);
    formData.append('comentario', comentario);
    formData.append('tipo', tipo);
    const response = await fetch(`http://music-scoreboard.com/api/comentar`, {
        method: "POST",
        body: formData
    });

    let json = await response.json();

    if (json.estado != 200) {
        alert(json.mensaje);
    } else {

        const formData = new FormData();
        formData.append('id', json.ultimo_id);
        formData.append('tipo', tipo);
        const response = await fetch(`http://music-scoreboard.com/api/plantillas/comentario`, {
            method: "POST",
            body: formData
        });

        let temp = document.createElement('div');
        temp.innerHTML += await response.text();
        let nuevoComentario = temp.querySelector('.contenedor-comentario');
        let comentariosContenedor = menu.querySelector('.comentarios-contenedor');
        comentariosContenedor.appendChild(nuevoComentario);
        
        boton.parentNode.querySelector('textarea').value = "";
        let textareaContenedor = boton.parentNode;
        let numeroCaracteres = textareaContenedor.querySelector('.numero-caracteres');
        numeroCaracteres.textContent = "0 / 250";
    }

}

async function darLike(idComentario, boton, tipo) {

    let formData = new FormData();
    formData.append('id', idComentario);
    formData.append('tipo', tipo);
    const response = await fetch("http://music-scoreboard.com/api/dar-like", {
        method: "POST",
        body: formData,
    });

    let json = await response.json();

    if (json.codigo == 200) {
        //actualizar icono de like

        let img = boton.querySelector('img');
        let numeroLikes = boton.querySelector('.numero-favs');

        if (json.fav) {
            img.src = "/img/iconos/fav.png";
            numeroLikes.textContent = Number(numeroLikes.textContent) + 1;
        } else {
            img.src = "/img/iconos/no_fav.png";
            numeroLikes.textContent = Number(numeroLikes.textContent) -1;
        }
      
    } else {
        alert(json.mensaje);
    }

}

function comentarInputListener (textarea) {

    let botonComentar = textarea.closest('.comentar-contenedor').querySelector('.boton-comentar');
    let numeroCaracteres = textarea.parentNode.querySelector('.numero-caracteres');
    let mensajeErrorValidacion = textarea.parentNode.querySelector('.mensaje-error-validacion');
    let caracteresLimite = 250;

    let validacion = validarComentario(textarea.value, botonComentar);
    if (validacion.estado) {
        let caracteres = textarea.value.length;
        numeroCaracteres.textContent = `${caracteres} / ${caracteresLimite}`;
        mensajeErrorValidacion.textContent = "";
    } else {
        mensajeErrorValidacion.textContent = validacion.cuerpo;
    }

}

function validarComentario(comentario, boton) {
    errores = [];
    if (comentario.length === 0) errores.push('El comentario está vacío. ¡No se olvide de escribirlo primero!');
    if (comentario.length > 250) errores.push('No se pueden enviar comentarios con más de 250 caracteres');

    mensaje = "";
    errores.forEach((error) => {
        mensaje += error + "\n";
    });

    if (errores.length === 0) {
        boton.disabled = false;
        return { estado: true };
    } else {
        boton.disabled = true;
        return { estado: false, cuerpo: mensaje };
    }
}


async function darLikeComentario(idComentario, boton) {

    let id = idComentario.split('comentario_')[1];

    let formData = new FormData();
    formData.append('id', id);
    const response = await fetch("http://music-scoreboard.com/api/like-comentario", {
        method: "POST",
        body: formData,
    });

    let json = await response.json();

    if (json.codigo == 200) {
        //actualizar icono de like
        let img = boton.querySelector('img');
        if (json.fav) {
            img.src = "/img/iconos/fav.png";
        } else {
            img.src = "/img/iconos/no_fav.png";
        }
    } else {
        alert(json.mensaje);
    }

}