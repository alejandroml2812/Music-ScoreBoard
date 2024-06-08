<?php

class ModeloComentariosArtistas {

    public static function crear ($conn, $usuarioId, $artistaId, $comentario) {
        //consulta
        $sql = "
            INSERT INTO comentarios_artistas(id_usuario, id_artista, comentario) 
            VALUES (\"$usuarioId\", \"$artistaId\", \"$comentario\");";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar un comentario(artistas) nuevo en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar ($conn, $id) {
        //consulta
        $sql = "SELECT 
        com.id as id_comentario, com.id_usuario as id_usuario, com.id_artista as id_artista, com.comentario as comentario,
        IF(est.id IS NULL,0,1) as id_estadisticas 
        FROM comentarios_artistas AS com
        LEFT JOIN likes_comentarios_artistas AS est
        ON com.id = est.id_comentario
        WHERE com.id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un comentario(artistas) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorIdArtista ($conn, $idArtista) {
        //consulta
        $sql = "SELECT id as id_comentario, id_usuario as id_usuario, id_artista as id_artista, comentario as comentario 
        FROM comentarios_artistas
        WHERE id_artista='$idArtista';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar comentarios(artistas) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorSlugArtista ($conn, $slugArtista) {
        //consulta
        $sql = "SELECT id as id_comentario, id_usuario as id_usuario, id_artista as id_artista, comentario as comentario 
        FROM comentarios_artistas
        WHERE id_artista=(SELECT id FROM artistas WHERE slug='$slugArtista');";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar comentarios(artistas) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorIdArtistaPaginado ($conn, $idArtista, $pagina, $limit) {
        //consulta

        $offset = ($pagina - 1) * $limit;

        $sql = "SELECT id as id_comentario, id_usuario as id_usuario, id_artista as id_artista, comentario as comentario 
        FROM comentarios_canciones 
        WHERE id_cancion='$idArtista'
        LIMIT $limit 
        OFFSET $offset;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar comentarios(artistas) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    //incluye información sobre si el usuario le ha dado like previamente o no
    public static function seleccionarPorIdArtistaConUsuario ($conn, $idArtista, $usuario) {
        //consulta
        $sql = "SELECT 
        com.id as id_comentario, com.id_usuario as id_usuario, com.id_artista as id_artista, com.comentario as comentario,
        IF(est.id IS NULL,0,1) as id_estadisticas 
        FROM comentarios_artistas AS com
        LEFT JOIN likes_comentarios AS est
        ON com.id = est.id_comentario
        WHERE 
            est.id_usuario = (SELECT id FROM usuarios WHERE nombreUsuario='$usuario')
            AND com.id_cancion='$idArtista'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar comentarios(artistas) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function actualizar ($conn, $id, $usuarioId, $artistaId, $comentario) {
        //consulta
        $sql = "UPDATE comentarios_canciones SET id_usuario='$usuarioId', id_artista='$artistaId', comentario='$comentario' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar un comentario(artistas) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrarPorId ($conn, $id) {
        //consulta
        $sql = "DELETE FROM comentarios_artistas WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar un comentario(artistas) por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

}