<?php

class CategoriaDTO {

    public $nombre;
    public $slug;
    public $descripcion;
    public $descripcionLarga;
    public $ruta;

    public function __construct ($id) {
        $categoria = ModeloCategorias::seleccionar($GLOBALS['conn'], $id);
        if (mysqli_num_rows($categoria) > 0) {
            $row = mysqli_fetch_assoc($categoria);
            $this->nombre = $row['nombre'];
            $this->slug = $row['slug'];
            $this->descripcion = $row['descripcion'];
            $this->ruta = $row['ruta'];
            $this->descripcionLarga = $row['descripcion_larga'];
        }
    }

}