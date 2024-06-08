<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/modelo/ModeloPuntuaciones.php";

class ControladorPuntuaciones
{

    public function mostrar()
    {
        return vista('puntuaciones');
    }

    public function mostrarPuntuacionPorNombreUsuario ($slug) {

    }

    /**
     * Devuelve un estado y permite crear una puntuación en la base de datos para determinada canción
     * Metodo REST API
     * @param queryString Lista clave => valor de los parametros GET/POST recibidos en la petición a la API
     */
    public function votarCancion ($queryString) {

        if (isset($_SESSION['usuario'])) {

            $usuarioId = $_SESSION['usuario']->id;

            $result = ModeloPuntuaciones::crear($GLOBALS['conn'], $usuarioId, $queryString['id'], $queryString['puntuacion']);
            if ($result) {
                echo json_encode(['codigo' => 200, 'texto' => 'OK']);
            } else {
                echo json_encode(['codigo' => 500, 'texto' => 'Internal Server Error: Ha habido un error al intentar crear la nueva puntuación en la base de datos']);
            }

        } else {

            echo json_encode(['codigo' => 401, 'texto' => 'Unauthorized: El usuario ha intentado votar una canción sin iniciar sesión.']);
        
        }

    }

}