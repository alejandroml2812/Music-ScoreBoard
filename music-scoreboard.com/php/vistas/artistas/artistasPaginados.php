<?php
$artistasDTO = $parametros['artistasDTO'];
$pagina = $parametros['pagina'];
$numeroPaginas = $parametros['numeroPaginas'];
$limit = $parametros['limit'];
?>
<div class="artistas-paginados-contenedor">
    <div class="artistas-paginados">
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
        <div class='barra-paginacion'>
            <label>Mostrando <?= count($artistasDTO) ?> resultados. Pág: <?= $pagina ?> / <?= $numeroPaginas ?></label>
            <ul id='barra' class='barra'>
                <?php
                for ($i = 1; $i <= $numeroPaginas; $i++) {

                    if ($pagina == $i) {
                ?>
                        <li class='actual'><a href="/artistas?pagina=<?= $i ?>"></a></li>
                    <?php
                    } else {
                    ?>
                        <li><a href="/artistas?pagina=<?= $i ?>"></a></li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>