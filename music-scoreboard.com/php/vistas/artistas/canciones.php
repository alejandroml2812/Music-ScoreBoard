<?php
$cancionesDTO = $parametros['cancionesDTO'];
?>
<h2>Canciones Populares</h2>
<div class='canciones-populares'>
    <ul class='cancion-popular'>
        <?php
        if (count($cancionesDTO) === 0) {
        ?>
            <p>No hay canciones que mostrar</p>
            <?php
        } else {
            for ($i = 0; $i < count($cancionesDTO); $i++) {
                $cancionDTO = $cancionesDTO[$i];
                if ($cancionDTO->numero_votos != 0) {
                    $puntuacion = number_format($cancionDTO->puntuacion_total / $cancionDTO->numero_votos, 2);
                } else {
                    $puntuacion = 0;
                }
            ?>

                <li id='<?= "menu_cancion_" . $cancionDTO->id ?>'>
                    <h2 class='cancion-artista'><img src="<?= $cancionDTO->album_ruta ?>" alt=""></h2>
                    <h3><?= $cancionDTO->album_nombre ?></h3>
                    <p><?= $cancionDTO->nombre ?></p>
                    <div class="dinamico">
                        <div class="puntuacion-display-contenedor col">
                            <div class="row">
                                <div class="prompt-contenedor">
                                    <p class="prompt puntuacion-cancion"><?= number_format($puntuacion, 2) ?></p>
                                </div>
                                <img class='icono-pequeno' src="/img/iconos/estrella.png" alt="">
                            </div>
                            <div class="row">
                                <div class="prompt-contenedor">
                                    <p class="prompt puntuacion-total-cancion"><?= number_format($cancionDTO->puntuacion_total, 0) ?></p>
                                </div>
                                <img class='icono-pequeno' src="/img/iconos/estadistica.png" alt="">
                            </div>
                            <div class="row">
                                <div class="prompt-contenedor">
                                    <p class="prompt numero-votos-cancion"><?= number_format($cancionDTO->numero_votos, 0) ?></p>
                                </div>
                                <img class='icono-pequeno' src="/img/iconos/usuarios.png" alt="">
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['usuario'])) {
                        ?>
                            <button class='fav-boton accion-boton' onclick='cargarMenuFavoritosPlantilla("<?= "menu_cancion_" . $cancionDTO->id ?>", "1", "cancion")'>
                                <img class='icono-pequeno' src="<?php if ($cancionDTO->fav) {
                                                                    echo '/img/iconos/fav.png';
                                                                } else {
                                                                    echo '/img/iconos/no_fav.png';
                                                                } ?>" alt="Botón para comentar">
                            </button>
                        <?php
                        }
                        ?>
                        <button class='comentarios-boton accion-boton' onclick='cargarMenuComentariosPlantilla("<?= "menu_cancion_" . $cancionDTO->id ?>", "1", "cancion")'>
                            <img class='icono-pequeno' src="/img/iconos/comentario.png" alt="Botón para comentar">
                        </button>
                    </div>
                    <input type="hidden" name="id" id="id" value="<?= $cancionDTO->id ?>">
                    <script src='/js/MenuFavoritos.js'></script>
                    <script src='/js/MenuComentarios.js'></script>
                    <script src='/js/funcionesMenus.js'></script>
                    </p>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</div>