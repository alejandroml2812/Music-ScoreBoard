<?php

class ModeloPuntuaciones {

    public static function crear ($conn, $usuarioId, $cancionId, $puntuacion) {
        //consulta
        $sql = "
            INSERT INTO puntuaciones(usuario_id, cancion_id, puntuacion) 
            VALUES (\"$usuarioId\", \"$cancionId\", \"$puntuacion\") 
            ON DUPLICATE KEY UPDATE usuario_id='$usuarioId', cancion_id='$cancionId', puntuacion='$puntuacion';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar una puntuación nueva en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar ($conn, $id) {
        //consulta
        $sql = "SELECT * FROM puntuaciones WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una puntuación por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPuntuacionCancionPorIdCancion ($conn, $id) {
        //consulta
        $sql = "SELECT SUM(puntuacion) as puntuacion_total, COUNT(*) as numero_votos FROM puntuaciones
        WHERE puntuaciones.cancion_id = '$id'
        GROUP BY puntuaciones.cancion_id;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una puntuación por id de canción: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarFavPorIdCancionIdUsuario ($conn, $cancionId, $usuarioId) {
        //consulta
        $sql = "SELECT p.puntuacion as puntuacion, IF(p.id IS NULL,0,1) as fav 
        FROM puntuaciones AS p
        WHERE 
            p.cancion_id = '$cancionId' AND p.usuario_id='$usuarioId';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un like(comentario de canción) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function actualizar ($conn, $id, $usuarioId, $cancionId, $puntuacion) {
        //consulta
        $sql = "UPDATE  puntuaciones SET usuario_id='$usuarioId', cancion_id='$cancionId', puntuacion='$puntuacion' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar una puntuación por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrarPorId ($conn, $id) {
        //consulta
        $sql = "DELETE FROM puntuaciones WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar una puntuación por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

}