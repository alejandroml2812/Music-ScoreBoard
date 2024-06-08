<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/Utilidades.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/modelo/ModeloArtistas.php";

class ArtistaDTO {

    public $id;
    public $nombre;
    public $slug;
    public $descripcion;
    public $descripcionLarga;
    public $ruta;

    function __construct ($conn, $id) {
        $result = ModeloArtistas::seleccionar($conn, $id);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->slug = $row['slug'];
            $this->descripcion = $row['descripcion'];
            $this->descripcionLarga = $row['descripcion_larga'];
            $this->ruta = $row['ruta'];
        }
    }

}