<?php
$favDTO = $parametros['favDTO'];
$puntuacion = $favDTO->puntuacion ?? 5;
$ruta = ($favDTO->fav) ? '/img/iconos/fav.png' : '/img/iconos/no_fav.png';
?>
<div class="menu favoritos">
    <h2>Favoritos</h2>
    <div class="puntuacion-contenedor">
        <h4>Tu Voto</h4>
        <p>Puntuación</p>
        <select name="puntuacion" class="puntuacion-select">
            <?php
            for ($i = 0; $i <= 10; $i++) {
            ?>
                <option <?php if ($i == $puntuacion) {
                            echo "selected";
                        } ?> value="<?= $i ?>"><?= $i ?></option>
            <?php
            }
            ?>
        </select>
        <div class="botonera">
            <button id="votar" class="votar" onclick="votarCancion(this)">Votar</button>
            <div class='icono-fav' style='background-image: url("<?= $ruta ?>")'><?php if ($favDTO !== null) echo $favDTO->puntuacion ?></div>
            <button id="cerrar" class="cerrar" onclick="cerrarMenu(this)">
                <img class='icono-pequeno' src="/img/iconos/cerrar.png" alt="">
            </button>
        </div>
    </div>
</div>