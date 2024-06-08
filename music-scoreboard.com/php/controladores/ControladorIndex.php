<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";

class ControladorIndex 
{
  public function mostrar()
  {
    return vista('index')->conRutasCSS([
      '/css/artistas.css',
      '/css/artista.css',
      '/css/index.css',
      '/css/categorias.css',
      '/css/responsive/responsive.css'
    ]);
    
  }
}
