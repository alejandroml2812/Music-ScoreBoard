<?php
$artistaDTO = $parametros['artistaDTO'];
//clase con funciones de vista
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
?>

<?php vista('viniloTitulo')->imprimirPlantilla() ?>

  <!-- CONTENIDO PRINCIPAL -> CARGAR CATEGORIAS Y DEJAR AL USUARIO ELEGIR -->
  <main class="main-artista">
    <section class='contenido'>
      <div class="miga">
        <a href="/artistas">Artistas</a>
        <p for="">/</p>
        <p for=""><?= $artistaDTO->nombre ?></p>
      </div>
      <p><?=$artistaDTO->descripcionLarga?></p>
    </section>
    <?php vista('artistas/artista_aside', $parametros)->imprimirPlantilla() ?>
  </main>