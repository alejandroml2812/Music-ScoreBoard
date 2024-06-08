<?php
$comentariosDTO = $parametros['comentariosDTO'];
$artistaDTO = $parametros['artistaDTO'];
?>

<h2>Comentarios</h2>
<div class="menu seccion-comentarios ">
    <div class="comentarios-contenedor">

        <?php
        if (count($comentariosDTO) === 0) {
        ?>
            <p>Aún no hay comentarios. ¡Sé el/la primero/a!</p>
            <?php
        } else {
            foreach ($comentariosDTO as $comentarioDTO) {
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
                            <button id='like' class='boton-interaccion' onclick="darLike('<?= $comentarioDTO->id ?>', this, 'artista')">
                                <p class="numero-favs"><?= $comentarioDTO->numeroFavs ?></p>
                                <img class='icono-pequeno' src="<?= ($comentarioDTO->fav) ? "/img/iconos/fav.png" : "/img/iconos/no_fav.png" ?>" alt="">
                            </button>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="comentar-contenedor">
        <div class="textarea-contenedor">
            <div class="textarea-info">
                <p class="numero-caracteres"></p>
                <div class="prompt-contenedor">
                    <p class="prompt mensaje-error-validacion"></p>
                </div>
            </div>
            <textarea oninput="comentarInputListener(this)" name="comentario" id="comentario_usuario" maxlength="250" placeholder="Comentar..."></textarea>
        </div>
        <button class="boton-comentar" disabled onclick="comentar(this, 'artista', '<?= $artistaDTO->id ?>')">Comentar</button>
    </div>
</div>