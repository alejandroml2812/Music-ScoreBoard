<?php
$comentarioDTO = $parametros['comentarioDTO'];
$tipo = $parametros['tipo'];
?>
<div id="id_comentario_<?= $comentarioDTO->id ?>" class="contenedor-comentario">
    <div class="contenedor-usuario">
        <img class='icono-mediano' src="<?= $comentarioDTO->usuario_ruta ?>" alt="">
        <div class='prompt-contenedor'>
            <p class='prompt'><?= $comentarioDTO->usuario_nombre ?></p>
        </div>
    </div>
    <div class="comentario" id="<?= "comentario_" . $comentarioDTO->id ?>">
        <?= $comentarioDTO->comentario ?>
        <div class="botonera-comentarios">
            <button id='like' class='boton-interaccion' onclick="darLike('<?= $comentarioDTO->id ?>', this, '<?= $tipo ?>')">
                <p class="numero-favs"><?= $comentarioDTO->numeroFavs ?></p>
                <img class='icono-pequeno' src="<?= ($comentarioDTO->fav) ? "/img/iconos/fav.png" : "/img/iconos/no_fav.png" ?>" alt="">
            </button>
        </div>
    </div>
</div>