//comportamiento de la pagina
document.getElementById("boton-registro").addEventListener("click", registro);
document.getElementById("boton-iniciar-sesion").addEventListener("click", login);

//variables
var formulario_login = document.querySelector(".formulario-login");
var formulario_registro = document.querySelector(".formulario-registro");
var contenedor_login_registro = document.querySelector(".contenedor_login-registro");
var fondo_login = document.querySelector(".fondo-login");
var fondo_registro = document.querySelector(".fondo-registro");
let formLogin = document.getElementById('formulario_login');
let mensajeErrorLogin = document.getElementById('mensaje_error_login');
let formRegistro = document.getElementById('formulario_registro');
let mensajeErrorRegistro = document.getElementById('mensaje_error_registro');

//mostrar form login
function login() {
    formulario_registro.classList.add('oculto');
    fondo_registro.classList.remove('oculto');

    formulario_login.classList.remove('oculto');
    fondo_login.classList.add('oculto');
}

//mostrar form registro
function registro() {
    formulario_registro.classList.remove('oculto');
    fondo_registro.classList.add('oculto');

    formulario_login.classList.add('oculto');
    fondo_login.classList.remove('oculto');
}

//boton login
function iniciarSesion () {
    if (validarFormulario(formLogin, mensajeErrorLogin)) {
        formLogin.submit();
    }
}

//boton de registrarse pulsado
function registrarse () {
    if (validarFormulario(formRegistro, mensajeErrorRegistro)) {
        formRegistro.submit();
    }
}