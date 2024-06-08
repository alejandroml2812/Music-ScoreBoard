<?php
$albumDTO = $parametros['albumDTO'];
$artistaDTO = $parametros['artistaDTO'];
//clase con funciones de vista
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
?>

<?php vista('viniloTitulo')->imprimirPlantilla() ?>

<!-- CONTENIDO PRINCIPAL -> CARGAR CATEGORIAS Y DEJAR AL USUARIO ELEGIR -->
<main class="main-album">
    <section class='contenido'>
        <div class="contenido">
            <div class="miga">
                <a href="/artistas">Artistas</a>
                <p>/</p>
                <a href="/artistas/<?= $artistaDTO->slug ?>"><?= $artistaDTO->nombre ?></a>
                <p>/</p>
                <p><?= $albumDTO->nombre ?></p>
            </div>
            <?= $albumDTO->descripcion ?>
        </div>
        <aside>
            <div class="imagen-contenedor" style='background-image: url("<?= $albumDTO->ruta ?>")'></div>
            <?php vista('artistas/canciones', $parametros)->imprimirPlantilla() ?>
        </aside>
    </section>
</main>