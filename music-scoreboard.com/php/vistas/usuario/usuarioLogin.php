<?php $usuario = $_SESSION['usuario'] ?>
<div class='usuario-perfil'>
    <img src="<?=$usuario->ruta?>" alt="Imagen de perfil">
    <div class='contenido'>
        <div class="prompt-contenedor"><p class="prompt"><?=$usuario->nombreUsuario?></p></div>
        <a class='link-card-mini' href="/logout">Cerrar Sesión</a>
    </div>
</div>