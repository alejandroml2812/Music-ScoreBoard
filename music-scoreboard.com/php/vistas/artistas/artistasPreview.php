<?php
$categoriaDTO = $parametros['categoriaDTO'];
$artistasDTO = $parametros['artistasDTO'];
?>
<div class="artistas-preview">
    <h1 class="titulo-seccion">Artistas</h1>
    <?php
    foreach ($artistasDTO as $artistaDTO) {
    ?>
        <div class='artista' style='background-image: url(<?= $artistaDTO->ruta ?>)'>
            <div class='contenido oculto'>
                <h2><?= $artistaDTO->nombre ?></h2>
                <p class='descripcion'><?= $artistaDTO->descripcion ?></p>
                <a class='link-card-mini link-card-primario' href='/artistas/<?= $artistaDTO->slug ?>'>Más</a>
            </div>
        </div>
    <?php
    }
    ?>
    <a class="link-card" href="/categorias/<?=$categoriaDTO->slug?>/artistas">Ver Todos</a>
</div>