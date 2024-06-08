<?php
$categoriasDTO = $parametros['categoriasDTO'];
?>

<h3 class="titulo-seccion">Categorías Populares</h3>
<section class="categorias-preview">
    <?php
    foreach ($categoriasDTO as $categoriaDTO) {
    ?>
        <div class="categoria" style='background-image: url("<?= $categoriaDTO['categoriaDTO']->ruta ?>")'>
            <div class="contenido oculto">
                <h3><?= $categoriaDTO['categoriaDTO']->nombre ?></h3>
                <p class="descripcion"><?= $categoriaDTO['categoriaDTO']->descripcion ?></p>
                <a class="link-card-mini" href="/categorias/<?= $categoriaDTO['categoriaDTO']->slug ?>">Ver</a>
            </div>
        </div>
    <?php
    }
    ?>
</section>