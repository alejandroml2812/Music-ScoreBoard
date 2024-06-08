<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/FavCancionDTO.php";

class ControladorPlantillas
{

    public function plantillaFavoritosCancion($queryString)
    {
        $favDTO = null;
        if (isset($_SESSION['usuario'])) {
            $favDatos = ModeloPuntuaciones::seleccionarFavPorIdCancionIdUsuario($GLOBALS['conn'], $queryString['id'], $_SESSION['usuario']->id);
            if (mysqli_num_rows($favDatos) > 0) {
                $row = mysqli_fetch_assoc($favDatos);
                $favDTO = new FavCancionDTO($row['puntuacion'], $row['fav']);
            }
        }

        vista('menus/favoritosCancion', ['favDTO' => $favDTO])->imprimirPlantilla();
    }

    public function plantillaComentarios($queryString)
    {

        $pagina = $queryString['pagina'] ?? 1;
        $tipo = $queryString['tipo'];
        $limit = 15;

        if (isset($queryString['id'])) {

            $id = $queryString['id'];

            switch ($tipo) {
                case "cancion":
                    $comentariosDatos = ModeloComentariosCanciones::seleccionarPorIdCancionPaginado($GLOBALS['conn'], $id, $pagina, $limit);
                    break;

                case "artista":
                    $comentariosDatos = ModeloComentariosArtistas::seleccionarPorIdArtistaPaginado($GLOBALS['conn'], $id, $pagina, $limit);
                    break;
            }

            $comentariosDTO = [];
            if (mysqli_num_rows($comentariosDatos) > 0) {
                while ($row = mysqli_fetch_assoc($comentariosDatos)) {
                    switch ($tipo) {
                        case "cancion": $comentariosDTO[] = new ComentarioCancionDTO($GLOBALS['conn'], $row['id_comentario']); break;
                        case "artista":$comentariosDTO[] = new ComentarioArtistaDTO($GLOBALS['conn'], $row['id_comentario']); break;
                    }
                    
                }
            }

            switch ($tipo) {

                case "cancion":
                    $cancionDatos = ModeloCanciones::seleccionar($GLOBALS['conn'], $id);
                    $cancionDTO = null;
                    if (mysqli_num_rows($cancionDatos) > 0) {
                        $row = mysqli_fetch_assoc($cancionDatos);
                        $cancionDTO = new CancionSimpleDTO($GLOBALS['conn'], $row['id']);
                    }

                    vista('menus/comentariosCancion', [
                        'comentariosDTO' => $comentariosDTO,
                        'cancionDTO' => $cancionDTO
                    ])->imprimirPlantilla();
                    break;

                case "artista":
                    $artistaDatos = ModeloArtistas::seleccionar($GLOBALS['conn'], $id);
                    $artistaDTO = null;
                    if (mysqli_num_rows($artistaDatos) > 0) {
                        $row = mysqli_fetch_assoc($artistaDatos);
                        $artistaDTO = new ArtistaDTO($GLOBALS['conn'], $row['id']);
                    }

                    if ($id !== null) {
                        vista('menus/comentariosArtista', [
                            'comentariosDTO' => $comentariosDTO,
                            'artistaDTO' => $artistaDTO
                        ])->imprimirPlantilla();
                    }
                    break;
            }
        } else {
            vista('errores/401', ['error' => 'Parámetro id requerido no recibido'])->imprimirPlantilla();
        }
    }

    public function plantillaComentariosArtista($queryString)
    {

        $pagina = $queryString['pagina'] ?? 1;
        $limit = 15;

        if (isset($queryString['id'])) {

            $id = $queryString['id'];

            $comentariosDatos = ModeloComentariosCanciones::seleccionarPorIdCancionPaginado($GLOBALS['conn'], $id, $pagina, $limit);
            $comentariosDTO = [];
            if (mysqli_num_rows($comentariosDatos) > 0) {
                while ($row = mysqli_fetch_assoc($comentariosDatos)) {
                    $comentariosDTO[] = new ComentarioCancionDTO($GLOBALS['conn'], $row['id_comentario']);
                }
            }

            $artistaDatos = ModeloArtistas::seleccionar($GLOBALS['conn'], $id);
            $artistaDTO = null;
            if (mysqli_num_rows($artistaDatos) > 0) {
                $row = mysqli_fetch_assoc($artistaDatos);
                $artistaDTO = new ArtistaDTO($GLOBALS['conn'], $row['id']);
            }

            if ($id !== null) {
                vista('menus/comentariosArtista', [
                    'comentariosDTO' => $comentariosDTO,
                    'artistaDTO' => $artistaDTO
                ])->imprimirPlantilla();
            }
        } else {

            vista('errores/401', ['error' => 'Parámetro id requerido no recibido'])->imprimirPlantilla();
        }
    }
}
