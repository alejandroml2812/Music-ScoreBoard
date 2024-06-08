<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modelo/ModeloComentariosArtistas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modelo/ModeloLikesComentariosArtistas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/ComentarioArtistaDTO.php";

class ControladorComentarios
{

    /**
     * Devuelve los comentarios asociados a una canción particular, y información sobre si el usuario le ha dado like
     * @param queryString Parametros de la petición HTTP. Requerido parámetro GET 'pagina'
     * @param id Id de la cancion de la que se cargarán los comentarios
     */
    public function comentarios($queryString, $id)
    {

        $tipo = $queryString['tipo'];
        $pagina = $queryString['pagina'] ?? 1;

        //si el usuario ha iniciado sesion, carga tambien informacion de si le ha dado like, sino no.
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            switch ($tipo) {
                case "cancion":
                    $comentarios = ModeloComentariosCanciones::seleccionarPorIdCancionConUsuario($GLOBALS['conn'], $id, $usuario->nombreUsuario);
                    break;
                case "artista":
                    $comentarios = ModeloComentariosArtistas::seleccionarPorIdArtistaConUsuario($GLOBALS['conn'], $id, $usuario->nombreUsuario);
                    break;
            }
        } else {
            switch ($tipo) {
                case "cancion":
                    $comentarios = ModeloComentariosCanciones::seleccionarPorIdCancion($GLOBALS['conn'], $id);
                    break;
                case "artista":
                    $comentarios = ModeloComentariosArtistas::seleccionarPorIdArtista($GLOBALS['conn'], $id);
                    break;
            }
        }

        //si ha habido un error en la consulta devolver 500
        if (!$comentarios) {
            $respuesta = [
                'codigo' => '500',
                'texto' => 'Internal Server Error',
                'cuerpo' => mysqli_error($GLOBALS['conn'])
            ];
            exit($respuesta);
        }

        //no ha fallado. Si hay registros, añadirlos a un array de comentarios para devolverlos
        $resultado = [];
        if (mysqli_num_rows($comentarios) > 0) {
            while ($row = mysqli_fetch_assoc($comentarios)) {
                $usuario = ModeloUsuarios::seleccionar($GLOBALS['conn'], $row['id_usuario']);
                if (mysqli_num_rows($usuario) > 0) {
                    $datosUsuario = mysqli_fetch_assoc($usuario);
                    switch ($tipo) {
                        case "cancion":
                            $resultado[] = new ComentarioCancionDTO($row['id_comentario'], $datosUsuario['nombreUsuario'], $datosUsuario['ruta'], $row['comentario'], $row['id_estadisticas']);
                            break;
                        case "artista":
                            $resultado[] = new ComentarioArtistaDTO($row['id_comentario'], $datosUsuario['nombreUsuario'], $datosUsuario['ruta'], $row['comentario'], $row['id_estadisticas']);
                            break;
                    }
                }
            }
            $respuesta = [
                'codigo' => '200',
                'texto' => 'OK',
                'cuerpo' => $resultado
            ];
        } else {
            $respuesta = [
                'codigo' => '204',
                'texto' => 'No Content',
                'cuerpo' => 'Aún no existen comentarios que mostrar'
            ];
        }
        echo json_encode($respuesta);
    }

    public function comentar($queryString)
    {
        $id = $queryString['id'];
        $tipo = $queryString['tipo'];
        $comentario = $queryString['comentario'];

        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $idUsuario = $usuario->id;
            switch ($tipo) {
                case "cancion":
                    if (ModeloComentariosCanciones::crear($GLOBALS['conn'], $idUsuario, $id, $comentario)) {
                        echo json_encode([
                            'estado' => 200,
                            'texto' => 'OK',
                            'mensaje' => 'El comentario se añadió con éxito',
                            'ultimo_id' => $GLOBALS['conn']->insert_id
                        ]);
                    } else {
                        echo json_encode([
                            'estado' => 500,
                            'texto' => 'Internal Server Error',
                            'mensaje' => 'Hubo un error al insertar el nuevo comentario en la base de datos'
                        ]);
                    }
                    break;
                case "artista":
                    if (ModeloComentariosArtistas::crear($GLOBALS['conn'], $idUsuario, $id, $comentario)) {
                        echo json_encode([
                            'estado' => 200,
                            'texto' => 'OK',
                            'mensaje' => 'El comentario se añadió con éxito',
                            'ultimo_id' => $GLOBALS['conn']->insert_id
                        ]);
                    } else {
                        echo json_encode([
                            'estado' => 500,
                            'texto' => 'Internal Server Error',
                            'mensaje' => 'Hubo un error al insertar el nuevo comentario en la base de datos'
                        ]);
                    }
                    break;
            }
        } else {
            echo json_encode([
                'estado' => 401,
                'texto' => 'Unauthorized',
                'mensaje' => 'El usuario no puede comentar sin iniciar sesión primero'
            ]);
        }
    }

    public function darLike($queryString)
    {

        $id = $queryString['id'];
        $tipo = $queryString['tipo'];
        

        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];

            switch ($tipo) {
                case "cancion":
                    $favDatos = ModeloLikesComentarios::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
                    break;
                case "artista":
                    $favDatos = ModeloLikesComentariosArtistas::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
                    break;
            }

            if (mysqli_num_rows($favDatos) > 0) {

                $registroFav = mysqli_fetch_assoc($favDatos);
                $fav = $registroFav['fav'];
                $favId = $registroFav['id'];

                if ($fav) {
                    //si ya habia like => quitar el like
                    switch ($tipo) {
                        case "cancion":
                            $result = ModeloLikesComentarios::borrar($GLOBALS['conn'], $favId);
                            break;
                        case "artista":
                            $result = ModeloLikesComentariosArtistas::borrar($GLOBALS['conn'], $favId);
                            break;
                    }
                    
                    if ($result) {
                        echo json_encode([
                            'codigo' => 200,
                            'mensaje' => 'El like(comentario) se ha eliminado con éxito de la base de datos',
                            'fav' => false
                        ]);
                    } else {
                        echo json_encode([
                            'codigo' => 500,
                            'mensaje' => 'Internal Server Error: Ha habido un error al eliminar el like(comentario de canción) en la base de datos',
                            'fav' => $fav
                        ]);
                    }
                } else {
                    //si no like => dar like
                    switch ($tipo) {
                        case "cancion": $result = ModeloLikesComentarios::crear($GLOBALS['conn'], $usuario->id, $id); break;
                        case "artista": $result = ModeloLikesComentariosArtistas::crear($GLOBALS['conn'], $usuario->id, $id); break;
                    }

                    if ($result) {
                        echo json_encode([
                            'codigo' => 200,
                            'mensaje' => 'El like(comentario) se ha añadido con éxito en la base de datos',
                            'fav' => true
                        ]);
                    } else {
                        echo json_encode([
                            'codigo' => 500,
                            'mensaje' => 'Internal Server Error: Ha habido un error al eliminar el like(comentario de canción) en la base de datos',
                            'fav' => $fav
                        ]);
                    }
                }
            } else {
                //no hay fav en la base de datos => crear
                //si no like => dar like

                switch ($tipo) {
                    case "cancion":
                        $result = ModeloLikesComentarios::crear($GLOBALS['conn'], $usuario->id, $id);
                        $favDatos = ModeloLikesComentarios::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
                        break;

                    case "artista":
                        $result = ModeloLikesComentariosArtistas::crear($GLOBALS['conn'], $usuario->id, $id);
                        $favDatos = ModeloLikesComentariosArtistas::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
                        break;
                }
                
                $registroFav = mysqli_fetch_assoc($favDatos);
                $fav = $registroFav['fav'];
                $favId = $registroFav['id'];

                if ($result) {
                    echo json_encode([
                        'codigo' => 200,
                        'mensaje' => 'El like(comentario) se ha añadido con éxito en la base de datos',
                        'fav' => true
                    ]);
                } else {
                    echo json_encode([
                        'codigo' => 500,
                        'mensaje' => 'Internal Server Error: Ha habido un error al eliminar el like(comentario de canción) en la base de datos',
                        'fav' => false
                    ]);
                }
            }
        } else {
            echo json_encode([
                'codigo' => 401,
                'mensaje' => 'Unauthorized: Para dar like a un comentario de una canción, el usuario debe haber iniciado sesión primero',
                'fav' => false
            ]);
        }
    }

    public function darLikeComentario($queryString)
    {

        $id = $queryString['id'];
        $tipo = $queryString['tipo'];

        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];

            switch ($tipo) {
                case "cancion":
                    $favDatos = ModeloLikesComentarios::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
                    break;
                case "artista":
                    $favDatos = ModeloLikesComentariosArtistas::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
                    break;
            }

            $favDatos = ModeloLikesComentariosArtistas::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
            if (mysqli_num_rows($favDatos) > 0) {

                $registroFav = mysqli_fetch_assoc($favDatos);
                $fav = $registroFav['fav'];
                $favId = $registroFav['id'];


                if ($fav) {
                    //si ya habia like => quitar el like
                    $result = ModeloLikesComentariosArtistas::borrar($GLOBALS['conn'], $favId);
                    if ($result) {
                        echo json_encode([
                            'codigo' => 200,
                            'mensaje' => 'El like(comentario de canción) se ha eliminado con éxito de la base de datos',
                            'fav' => false
                        ]);
                    } else {
                        echo json_encode([
                            'codigo' => 500,
                            'mensaje' => 'Internal Server Error: Ha habido un error al eliminar el like(comentario de canción) en la base de datos',
                            'fav' => $fav
                        ]);
                    }
                } else {
                    //si no like => dar like
                    $result = ModeloLikesComentariosArtistas::crear($GLOBALS['conn'], $usuario->id, $favId);

                    if ($result) {
                        echo json_encode([
                            'codigo' => 200,
                            'mensaje' => 'El like(comentario de canción) se ha añadido con éxito en la base de datos',
                            'fav' => true
                        ]);
                    } else {
                        echo json_encode([
                            'codigo' => 500,
                            'mensaje' => 'Internal Server Error: Ha habido un error al eliminar el like(comentario de canción) en la base de datos',
                            'fav' => $fav
                        ]);
                    }
                }
            } else {
                //no hay fav en la base de datos => crear
                //si no like => dar like

                switch ($tipo) {
                    case "cancion":
                        $result = ModeloLikesComentarios::crear($GLOBALS['conn'], $usuario->id, $id);
                        $favDatos = ModeloLikesComentarios::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
                        break;

                    case "artista":
                        $result = ModeloLikesComentariosArtistas::crear($GLOBALS['conn'], $usuario->id, $id);
                        $favDatos = ModeloLikesComentariosArtistas::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
                        break;
                }
                
                $registroFav = mysqli_fetch_assoc($favDatos);
                $fav = $registroFav['fav'];
                $favId = $registroFav['id'];

                if ($result) {
                    echo json_encode([
                        'codigo' => 200,
                        'mensaje' => 'El like(comentario de canción) se ha añadido con éxito en la base de datos',
                        'fav' => true
                    ]);
                } else {
                    echo json_encode([
                        'codigo' => 500,
                        'mensaje' => 'Internal Server Error: Ha habido un error al eliminar el like(comentario de canción) en la base de datos',
                        'fav' => false
                    ]);
                }
            }
        } else {
            echo json_encode([
                'codigo' => 401,
                'mensaje' => 'Unauthorized: Para dar like a un comentario de una canción, el usuario debe haber iniciado sesión primero',
                'fav' => false
            ]);
        }
    }


    public function plantilla ($queryString) {

        $id = $queryString['id'];
        $tipo = $queryString['tipo'];

        switch ($tipo) {
            case "cancion": $comentarioDatos = ModeloComentariosCanciones::seleccionar($GLOBALS['conn'], $id); break;
            case "artista": $comentarioDatos = ModeloComentariosArtistas::seleccionar($GLOBALS['conn'], $id); break;
        }

        if (mysqli_num_rows($comentarioDatos) > 0) {
            $row = mysqli_fetch_assoc($comentarioDatos);
            switch ($tipo) {
                case "cancion": $comentarioDTO = new ComentarioCancionDTO($GLOBALS['conn'], $row['id_comentario']); break;
                case "artista": $comentarioDTO = new ComentarioArtistaDTO($GLOBALS['conn'], $row['id_comentario']); break;
            }

            vista('plantillas/comentario', ['comentarioDTO' => $comentarioDTO, 'tipo' => $tipo])->imprimirPlantilla();

        }

    }

}
