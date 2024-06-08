<?php
//clase con funciones de vista
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
?>

<?php vista('viniloTitulo')->imprimirPlantilla() ?>

<!-- CONTENIDO PRINCIPAL -> CARGAR CATEGORIAS Y DEJAR AL USUARIO ELEGIR -->
<main>
  <section class="categorias">
    <h1 class="titulo-seccion">Categorías</h1>
    <?php echo Vista::categorias($GLOBALS['conn']); ?>
  </section>
</main>