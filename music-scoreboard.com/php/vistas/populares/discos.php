<?php
$albumesDTO = $parametros['albumesDTO'];
?>
<h3 class='titulo-seccion'>Discos Populares</h3>
<section class='discos'>
    <?php
    foreach ($albumesDTO as $albumDTO) {
    ?>
        <a href="/artistas/<?=$albumDTO['artistaDTO']->slug?>/<?=$albumDTO['albumDTO']->slug?>" class='disco' style='background-image: url("<?= $albumDTO['albumDTO']->ruta ?>")'>
            <div class="contenido">
                <p><?= $albumDTO['albumDTO']->nombre ?></p>
            </div>
        </a>
    <?php
    }
    ?>
</section>