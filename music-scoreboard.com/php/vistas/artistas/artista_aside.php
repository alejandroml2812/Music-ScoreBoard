<?php
$artistaDTO = $parametros['artistaDTO'];
?>

<aside>
    <div class='imagen-contenedor' style='background-image: url("<?= $artistaDTO->ruta ?>")'></div>
    <div class='aside-contenido'>
        <?php vista('artistas/discos', $parametros)->imprimirPlantilla() ?>  
        <?php vista('artistas/canciones', $parametros)->imprimirPlantilla() ?>  
        <?php vista('artistas/artistaComentarios', $parametros)->imprimirPlantilla() ?>  
    </div>
</aside>