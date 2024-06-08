<?php

class CancionSimpleDTO {

    public $id;
    public $nombre;
    public $letra;
    public $ruta;

    public function __construct ($conn, $id) {
        $datos = ModeloCanciones::seleccionar($conn, $id);
        if (mysqli_num_rows($datos) > 0) {
            $row = mysqli_fetch_assoc($datos);
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->letra = $row['letra'];
            $this->ruta = $row['ruta'];
        }
    }

}