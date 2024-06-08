<?php

class ModeloAlbumes {

    public static function crear ($conn, $artistaId, $nombre, $ruta, $slug) {
        //consulta
        $sql = "INSERT INTO albumes(artista_id, nombre, ruta, slug) VALUES (\"$artistaId\", \"$nombre\", \"$ruta\", \"$slug\");";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar un álbum nuevo en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar ($conn, $id) {
        //consulta
        $sql = "SELECT * FROM albumes WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un álbum por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPopularesLimit ($conn, $limit) {
        //consulta
        $sql = "SELECT al.id as id, art.id as artista_id, SUM(p.puntuacion) as puntuacion_total FROM albumes al 
        LEFT JOIN canciones c 
        ON c.album_id=al.id 
        LEFT JOIN puntuaciones p 
        ON p.cancion_id=c.id
        LEFT JOIN artistas art
        ON al.artista_id=art.id
        WHERE p.puntuacion IS NOT NULL
        GROUP BY al.id
        ORDER BY puntuacion_total DESC 
        LIMIT $limit;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un álbum por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorNombre ($conn, $nombre) {
        //consulta
        $sql = "SELECT * FROM albumes WHERE nombre='$nombre'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un álbum por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorSlug ($conn, $slug) {
        //consulta
        $sql = "SELECT * FROM albumes WHERE slug='$slug'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un álbum por slug: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorNombreArtista ($conn, $nombre) {
        //consulta
        $sql = "SELECT albumes.id as id, albumes.nombre as album_nombre, albumes.ruta as album_ruta, albumes.slug as slug FROM albumes JOIN artistas
        WHERE albumes.artista_id = artistas.id
        AND artistas.nombre = '$nombre'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar los álbumes por nombre de artista ($nombre): " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function actualizar ($conn, $id, $artistaId, $nombre, $ruta) {
        //consulta
        $sql = "UPDATE canciones SET artista_id='$artistaId', nombre='$nombre', ruta='$ruta' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar un álbum por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrarPorId ($conn, $id) {
        //consulta
        $sql = "DELETE FROM albumes WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar un álbum por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

}