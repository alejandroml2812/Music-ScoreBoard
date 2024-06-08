<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modelo/ModeloComentariosCanciones.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modelo/ModeloLikesComentarios.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/ComentarioCancionDTO.php";

class ControladorComentariosCanciones
{

    /**
     * Devuelve los comentarios asociados a una canción particular, y información sobre si el usuario le ha dado like
     * @param queryString Parametros de la petición HTTP. Requerido parámetro GET 'pagina'
     * @param id Id de la cancion de la que se cargarán los comentarios
     */
    public function comentariosCancion($queryString, $id)
    {

        $pagina = $queryString['pagina'];

        //si el usuario ha iniciado sesion, carga tambien informacion de si le ha dado like, sino no.
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $comentarios = ModeloComentariosCanciones::seleccionarPorIdCancionConUsuario($GLOBALS['conn'], $id, $usuario->nombreUsuario);
        } else {
            $comentarios = ModeloComentariosCanciones::seleccionarPorIdCancion($GLOBALS['conn'], $id);
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
                    $resultado[] = new ComentarioCancionDTO($row['id_comentario'], $datosUsuario['nombreUsuario'], $datosUsuario['ruta'], $row['comentario'], $row['id_estadisticas']);
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

    public function comentarCancion($queryString)
    {
        $id = $queryString['id'];
        $comentario = $queryString['comentario'];

        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $idUsuario = $usuario->id;
            if (ModeloComentariosCanciones::crear($GLOBALS['conn'], $idUsuario, $id, $comentario)) {
                echo json_encode([
                    'estado' => 200,
                    'texto' => 'OK',
                    'mensaje' => 'El comentario se añadió con éxito'
                ]);
            } else {
                echo json_encode([
                    'estado' => 500,
                    'texto' => 'Internal Server Error',
                    'mensaje' => 'Hubo un error al insertar el nuevo comentario en la base de datos'
                ]);
            }
        } else {
            echo json_encode([
                'estado' => 401,
                'texto' => 'Unauthorized',
                'mensaje' => 'El usuario no puede comentar sin iniciar sesión primero'
            ]);
        }
    }

    public function darLikeComentario($queryString)
    {
        $id = $queryString['id'];
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];

            $favDatos = ModeloLikesComentarios::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
            if (mysqli_num_rows($favDatos) > 0) {

                $registroFav = mysqli_fetch_assoc($favDatos);
                $fav = $registroFav['fav'];
                $favId = $registroFav['id'];


                if ($fav) {
                    //si ya habia like => quitar el like
                    $result = ModeloLikesComentarios::borrar($GLOBALS['conn'], $favId);
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
                    $result = ModeloLikesComentarios::crear($GLOBALS['conn'], $usuario->id, $favId);

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
                $result = ModeloLikesComentarios::crear($GLOBALS['conn'], $usuario->id, $id);

                $favDatos = ModeloLikesComentarios::seleccionarFavPorIdComentario($GLOBALS['conn'], $usuario->id, $id);
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
}
