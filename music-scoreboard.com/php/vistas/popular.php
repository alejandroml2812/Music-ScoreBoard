<?php
//clase con funciones de vista
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
?>


<?php vista('viniloTitulo')->imprimirPlantilla() ?>

<!-- CONTENIDO PRINCIPAL -> CARGAR CATEGORIAS Y DEJAR AL USUARIO ELEGIR -->
<main class="popular">
  <div>
  <?php vista('populares/categorias', ['categoriasDTO' => $parametros['categoriasDTO']])->imprimirPlantilla() ?>
  <?php vista('populares/artistas', ['artistasDTO' => $parametros['artistasDTO']])->imprimirPlantilla() ?>
  <?php vista('populares/discos', ['albumesDTO' => $parametros['albumesDTO']])->imprimirPlantilla() ?>
    <!--
    <section class="discos-preview">
      <h2 class='titulo-seccion'>Discos</h2>
      <?php //echo Vista::discosPopularesPreviewLimit($GLOBALS['conn'], 5) ?>
    </section>
    -->
  </div>
  <!--
  <aside class="destacado">
    <?php //echo Vista::destacadoPopular($GLOBALS['conn']); ?>
  </aside>
-->
</main>