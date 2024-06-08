<?php
//clase con funciones de vista
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
?>


<?php vista('viniloTitulo')->imprimirPlantilla() ?>

<!-- CONTENIDO PRINCIPAL -> CARGAR CATEGORIAS Y DEJAR AL USUARIO ELEGIR -->
<main class="index">
  <div>

    <section class="categorias-preview">
      <h1 class="titulo-seccion">Categorías</h1>
      <?php echo Vista::categoriasLimit($GLOBALS['conn'], 4); ?>
      <a class="link-card link-card-primario" href="/categorias">Ver más</a>
    </section>

    <section class="artistas-preview">
      <h2 class='titulo-seccion'>Artistas</h2>
      <?php echo Vista::artistasPreviewLimit($GLOBALS['conn'], 5) ?>
      <a class="link-card" href="/artistas">Ver más</a>
    </section>
    
  </div>
  <aside class="destacado">
    <?php echo Vista::destacado($GLOBALS['conn']); ?>
  </aside>
</main>