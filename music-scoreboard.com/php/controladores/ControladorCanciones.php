<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/CancionFavoritosDTO.php";

class ControladorCanciones {

    public function apiCancion ($queryString, $id) {

        $datosCancion = ModeloCanciones::seleccionar($GLOBALS['conn'], $id);
        if (mysqli_num_rows($datosCancion) > 0) {
            $row = mysqli_fetch_assoc($datosCancion);
            $cancionDTO = new CancionFavoritosDTO($GLOBALS['conn'], $row['id']);
            $respuesta = [
                'codigo' => 200,
                'estado' => 'OK',
                'cuerpo' => $cancionDTO
            ];
        } else {
            $respuesta = [
                'codigo' => 404,
                'estado' => 'Not Found',
                'mensaje' => 'No se ha encotrado la canción de la base de datos o no existe'
            ];
        }

        return json_encode($respuesta);
    }

}