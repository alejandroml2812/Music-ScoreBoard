<?php
//clase con funciones de vista
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
$artistasDTO = $parametros['artistasDTO'];
$pagina = $parametros['pagina'];
$limit = $parametros['limit'];
?>

<div class="vinilo-titulo">
  <div class="vinilo">
    <img class="rotarZ-lento" src="/img/iconos/disco.png" alt="">
    <h2 class="rotarZ-lento">Music ScoreBoard</h2>
  </div>
  <div class="contenido">
    <div class="bocadillo rebotarY">
      ¡Bienvenidos a music-scoreboard.com! ¡Hecha un vistazo a los artistas más populares y vota a los que más te gusten!
    </div>
    <div class="persona-contenedor">
      <img class="persona" src="/img/utilidad/publicidad_1.png" alt="">
    </div>
  </div>
</div>

<!-- CONTENIDO PRINCIPAL -> CARGAR CATEGORIAS Y DEJAR AL USUARIO ELEGIR -->
<main>
  <section class="artistas">
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
  </section>
</main>