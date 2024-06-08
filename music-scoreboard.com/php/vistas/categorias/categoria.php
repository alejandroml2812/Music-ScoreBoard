<?php
$categoriaDTO = $parametros['categoriaDTO'];
?>

<?php vista('viniloTitulo')->imprimirPlantilla() ?>

<main class="main-categoria">
    <?php
    if ($categoriaDTO === null) {
    ?>
        <p class='error relativo'><?= $parametros['error'] ?></p>
        <a class="link-card link-card-primario" href='/categorias'>Volver</a>
    <?php
    } else {
    ?>
        <div class="categoria">
            <h1><?= $categoriaDTO->nombre ?></h1>
            <div class="miga">
                <a href="/categorias">Categorías</a>
                <label for="">/</label>
                <label for=""><?= $categoriaDTO->nombre ?></label>
            </div>
            <div class="imagen-contenedor" style='background-image: url("<?= $categoriaDTO->ruta ?>")'></div>
            <p><?= $categoriaDTO->descripcionLarga ?></p>
        </div>
        <aside>
            <section class="artistas">
                <?php vista('artistas/artistasPreview', $parametros)->imprimirPlantilla() ?>
            </section>
        </aside>
    <?php
    }
    ?>
</main>