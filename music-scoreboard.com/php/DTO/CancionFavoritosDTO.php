<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/CancionSimpleDTO.php";

class CancionFavoritosDTO {

    public $cancionDTO;
    public $puntuacionTotal;
    public $numeroVotos;

    public function __construct ($conn, $id) {

        $this->cancionDTO = new CancionSimpleDTO($conn, $id);

        $puntuacionDatos = ModeloPuntuaciones::seleccionarPuntuacionCancionPorIdCancion($GLOBALS['conn'], $id);
        if (mysqli_num_rows($puntuacionDatos)) {
            $row = mysqli_fetch_assoc($puntuacionDatos);
            $this->puntuacionTotal = $row['puntuacion_total'];
            $this->numeroVotos = $row['numero_votos'];
        }

    }

}