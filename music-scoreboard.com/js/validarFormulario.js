function listenerValidacionFormulario (formId, contenedorMensajeId) {

    let form = document.getElementById(formId);
    let mensajeError = document.getElementById(contenedorMensajeId);
    let boton = form.querySelector("button[type='submit']");

    let validacion = validarFormulario(form, mensajeError);
    if (validacion) {
        boton.setAttribute('disabled', false);
    } else {
        boton.setAttribute('disabled', true);
    }

    //validar cada vez que se hace input en el form => cambiar estado del boton a habilitado
    form.addEventListener('input', () => {
        let validacion = validarFormulario(form, mensajeError);
        if (validacion) {
            boton.disabled = false;
        } else {
            boton.disabled = true;
        }
    });

}

function validarFormulario (form, mensajeError) {

    mensajeError.innerHTML = "";

    let campos = form.querySelectorAll('input');
    let mensajes = [];
    for (let i = 0; i < campos.length; i++) {
        let validacion = validarCampo(campos[i]);
        if (!validacion.esValido) {
            mensajes.push(validacion.mensaje);
        }
    }
    let errorHTML = document.createElement('ul');
    for (let i = 0; i < mensajes.length; i++) {
        let li = document.createElement('li');
        li.textContent = mensajes[i];
        errorHTML.appendChild(li);
    }
    mensajeError.appendChild(errorHTML);
    return mensajes.length === 0;
}

function validarCampo (campo) {
    switch (campo.name) {
        case "usuarioLogin": return validarUsuario(campo.value);
        case "contrasenaLogin": return validarContrasena(campo.value);
        case "usuarioRegistro": return validarUsuario(campo.value);
        case "contrasenaRegistro": return validarContrasena(campo.value);
        case "correoRegistro": return validarCorreo(campo.value);
    }
}

function validarUsuario (usuario) {
    let regexp = new RegExp(/[a-zA-Z0-9_]+/);
    return {
        esValido: regexp.test(usuario),
        mensaje: 'El usuario solo puede contener caracteres alfanuméricos en mayúscula o minúscula y el símbolo _. El usuario debe contener como mínimo 1 caracter'
    };
}

function validarContrasena (contrasena) {
    let regexp = new RegExp(/[a-zA-Z0-9\_\-\,.\¡\!\¿\?\=]+/);
    return {
        esValido: regexp.test(contrasena),
        mensaje: 'La contraseña solo puede contener caracteres alfanuméricos en mayúscula o minúscula y los símbolos especiales siguientes: _-,.¡!¿?= El usuario debe contener como mínimo 1 caracter'
    };
}

function validarCorreo (correo) {
    let regexp = new RegExp(/^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/);
    return {
        esValido: regexp.test(correo),
        mensaje: 'El correo no es válido. ¿Tiene el TLD más de 1 caracter y menos de 11?'
    };
}