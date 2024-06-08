<?php
$artistaDTO = $parametros['artistaDTO'];
$albumesDTO = $parametros['albumesDTO'];
?>
<h2>Discos</h2>
<div class='discos'>
    <?php
    if (count($albumesDTO) === 0) {
    ?>
        <p class='fila-completa'>Ningún disco que mostrar</p>
        <?php
    } else {
        foreach ($albumesDTO as $albumDTO) {
        ?>
            <a href="/artistas/<?= $artistaDTO->slug ?>/<?= $albumDTO->slug ?>" class='disco' style='background-image: url("<?= $albumDTO->ruta ?>")'>
                <div class="contenido">
                    <p><?= $albumDTO->nombre ?></p>
                </div>
            </a>
    <?php
        }
    }
    ?>
</div>