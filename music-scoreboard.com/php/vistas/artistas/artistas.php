<?php
//clase con funciones de vista
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
?>

<?php vista('viniloTitulo')->imprimirPlantilla() ?>

<!-- CONTENIDO PRINCIPAL -> CARGAR CATEGORIAS Y DEJAR AL USUARIO ELEGIR -->
<main class="main-artistas">
  <section class="artistas-paginados-contenedor">
    <?php vista('/artistas/artistasPaginados', $parametros)->conRutasCSS([
      '/css/artistas.css',
      '/css/artista.css'
    ])->imprimirPlantilla() ?>
  </section>
</main>