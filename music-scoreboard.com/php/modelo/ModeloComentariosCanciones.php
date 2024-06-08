<?php

class ModeloComentariosCanciones {

    public static function crear ($conn, $usuarioId, $cancionId, $comentario) {
        //consulta
        $sql = "
            INSERT INTO comentarios_canciones(id_usuario, id_cancion, comentario) 
            VALUES (\"$usuarioId\", \"$cancionId\", \"$comentario\") 
            ON DUPLICATE KEY UPDATE id_usuario='$usuarioId', id_cancion='$cancionId', comentario='$comentario';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar un comentario(canciones) nuevo en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar ($conn, $id) {
        //consulta
        $sql = "SELECT 
        com.id as id_comentario, com.id_usuario as id_usuario, com.id_cancion as id_cancion, com.comentario as comentario,
        IF(est.id IS NULL,0,1) as id_estadisticas 
        FROM comentarios_canciones AS com
        LEFT JOIN likes_comentarios AS est
        ON com.id = est.id_comentario
        WHERE com.id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un comentario(canciones) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorIdCancion ($conn, $idCancion) {
        //consulta
        $sql = "SELECT id as id_comentario, id_usuario as id_usuario, id_cancion as id_cancion, comentario as comentario 
        FROM comentarios_canciones 
        WHERE id_cancion='$idCancion';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar comentarios(canciones) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorIdCancionPaginado ($conn, $idCancion, $pagina, $limit) {
        //consulta

        $offset = ($pagina - 1) * $limit;

        $sql = "SELECT id as id_comentario, id_usuario as id_usuario, id_cancion as id_cancion, comentario as comentario 
        FROM comentarios_canciones 
        WHERE id_cancion='$idCancion'
        LIMIT $limit 
        OFFSET $offset;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar comentarios(canciones) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    //incluye información sobre si el usuario le ha dado like previamente o no
    public static function seleccionarPorIdCancionConUsuario ($conn, $idCancion, $usuario) {
        //consulta
        $sql = "SELECT 
        com.id as id_comentario, com.id_usuario as id_usuario, com.id_cancion as id_cancion, com.comentario as comentario,
        IF(est.id IS NULL,0,1) as id_estadisticas 
        FROM comentarios_canciones AS com
        LEFT JOIN likes_comentarios AS est
        ON com.id = est.id_comentario
        WHERE 
            est.id_usuario = (SELECT id FROM usuarios WHERE nombreUsuario='$usuario')
            AND com.id_cancion='$idCancion'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar comentarios(canciones) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function actualizar ($conn, $id, $usuarioId, $cancionId, $comentario) {
        //consulta
        $sql = "UPDATE  comentarios_canciones SET id_usuario='$usuarioId', id_cancion='$cancionId', comentario='$comentario' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar un comentario(canciones) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrarPorId ($conn, $id) {
        //consulta
        $sql = "DELETE FROM comentarios_canciones WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar un comentario(canciones) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

}