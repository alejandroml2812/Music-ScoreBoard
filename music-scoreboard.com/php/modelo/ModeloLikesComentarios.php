<?php

class ModeloLikesComentarios {

    public static function crear ($conn, $idUsuario, $idComentario) {
        //consulta

        //insert ignore: si ya se ha dado like, ignorar consulta ya que es de tipo crear
        $sql = "
            INSERT INTO likes_comentarios(id_usuario, id_comentario) 
            VALUES (\"$idUsuario\", \"$idComentario\");";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar un nuevo like(comentario de canción) en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar ($conn, $id) {
        //consulta
        $sql = "SELECT * FROM likes_comentarios WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un like(comentario de canción) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarFavPorIdComentario ($conn, $idUsuario, $idComentario) {
        //consulta
        $sql = "SELECT likes.id as id, IF(likes.id IS NULL,0,1) as fav, COUNT(likes.id) as numero_favs 
        FROM comentarios_canciones AS com
        LEFT JOIN likes_comentarios AS likes
        ON com.id = likes.id_comentario
        WHERE 
            likes.id_comentario = '$idComentario' AND likes.id_usuario='$idUsuario';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un like(comentario de canción) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function actualizar ($conn, $id, $idUsuario, $idComentario) {
        //consulta
        $sql = "UPDATE  likes_comentarios SET id_usuario='$idUsuario', id_comentario='$idComentario' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar un like(comentario de canción) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrar ($conn, $id) {
        //consulta
        $sql = "DELETE FROM likes_comentarios WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar un like(comentario de canción) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

}