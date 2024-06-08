<?php if ($parametros != null && isset($parametros['error'])) {
  echo Vista::error($parametros['error']);
} ?>
<main class="login">
<!--CONTENIDO PRINCIPAL-->
<div class="contenedor_principal">
  <div class="fondo">

    <div class="fondo-login oculto">
      <h3>¿Ya tienes cuenta?</h3>
      <p>Inicia sesión para entrar en la página</p>
      <button id="boton-iniciar-sesion">Iniciar Sesión</button>
    </div>

    <div class="fondo-registro">
      <h3>¿Aún no tienes cuenta?</h3>
      <p>Registrate para iniciar sesión</p>
      <button id="boton-registro">Registrarse</button>
    </div>
  </div>

  <div class="contenedor_login-registro">
    <!--FORMULARIO LOGIN-->
    <form id="formulario_login" action="/login" method="POST" class="formulario-login">
      <h2>Iniciar Sesión</h2>
      <div class="inputs">
        <div class="input">
          <label for="usuarioLogin">Usuario</label>
          <input id="usuarioLogin" type="text" placeholder="Nombre de usuario" name="usuarioLogin" autocomplete="true">
        </div>
        <div class="input">
          <label for="contrasenaLogin">Contraseña</label>
          <input id="contrasenaLogin" type="password" placeholder="Contraseña" name="contrasenaLogin" autocomplete="false">
        </div>
      </div>
      <div class="mensaje-error-validacion" id='mensaje_error_login'></div>
      <button type="submit" class="link-card-mini" onclick="iniciarSesion()">Iniciar Sesión</button>
    </form>

    <!--FORMULARIO REGISTRO-->
    <form id="formulario_registro" action="/registro" method="POST" class="formulario-registro oculto">
      <h2>Registrarse</h2>
      <div class="inputs">
        <div class="input">
          <label for="usuarioRegistro">Usuario</label>
          <input id="usuarioRegistro" type="text" placeholder="Nombre de usuario" name="usuarioRegistro" autocomplete="false">
        </div>
        <div class="input">
          <label for="correoRegistro">Correo</label>
          <input id="correoRegistro" type="email" placeholder="E-Mail" name="correoRegistro" autocomplete="true">
        </div>
        <div class="input">
          <label for="contrasenaRegistro">Contraseña</label>
          <input id="contrasenaRegistro" type="password" placeholder="Contraseña" name="contrasenaRegistro" autocomplete="false">
        </div>
      </div>
      <div class="mensaje-error-validacion" id='mensaje_error_registro'></div>
      <button type="submit" class="link-card-mini">Registrarse</button>
    </form>
  </div>
</div>
</main>

<script src='/js/login.js'></script>
<script src='/js/validarFormulario.js'></script>
<script>
  listenerValidacionFormulario('formulario_login', 'mensaje_error_login');
  listenerValidacionFormulario('formulario_registro', 'mensaje_error_registro');
  registro();
</script>