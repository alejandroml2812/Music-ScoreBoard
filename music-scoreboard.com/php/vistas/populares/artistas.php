<?php
$artistasDTO = $parametros['artistasDTO'];
?>
<h3 class='titulo-seccion'>Artistas Populares</h3>
<section class="artistas-preview">
    
<?php
foreach ($artistasDTO as $artistaDTO) {
?>
    <a class="artista" href="/artistas/<?=$artistaDTO['artistaDTO']->slug?>" style='background-image: url("<?=$artistaDTO['artistaDTO']->ruta?>")'></a>
<?php
}
?>
</section>