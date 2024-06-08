<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/Utilidades.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/modelo/ModeloAlbumes.php";

class AlbumDTO {

    public $nombre;
    public $slug;
    public $ruta;
    public $descripcion;

    function __construct ($conn, $albumId) {
        $result = ModeloAlbumes::seleccionar($conn, $albumId);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $this->nombre = $row['nombre'];
            $this->slug = $row['slug'];
            $this->ruta = $row['ruta'];
            $this->descripcion = $row['descripcion'];
        }
    }

}