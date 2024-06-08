<?php

class ModeloCanciones {

    public static function crear ($conn, $nombre, $albumId, $letra, $ruta) {
        //consulta
        $sql = "INSERT INTO canciones(nombre, album_id, letra, ruta) VALUES ($nombre, $albumId, $letra, $ruta);";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar una canción nueva en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar ($conn, $id) {
        //consulta
        $sql = "SELECT * FROM canciones WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una canción por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorNombre ($conn, $nombre) {
        //consulta
        $sql = "SELECT * FROM canciones WHERE nombre='$nombre'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una canción por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarDTOPorIdArtista ($conn, $idArtista) {
        //consulta
        $sql = "SELECT 
        c.id as id, c.nombre as nombre, c.letra as letra, c.ruta as ruta, 
        al.nombre as album_nombre, al.ruta as album_ruta, 
        art.nombre as artista_nombre, art.descripcion as artista_descripcion, art.ruta as artista_ruta, art.slug as artista_slug, 	
        COALESCE(SUM(p.puntuacion), 0) as puntuacion_total, 
        COUNT(p.puntuacion) as numero_votos, IF(p.id IS NULL,0,1) as fav
    FROM canciones c
    LEFT JOIN albumes al
        ON c.album_id = al.id
    LEFT JOIN artistas art
        ON al.artista_id = art.id
    LEFT JOIN puntuaciones p
        ON c.id = p.cancion_id
    WHERE art.id='$idArtista'
        GROUP BY c.id;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una canción por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarDTOPopularesPorIdArtistaLimit ($conn, $idArtista, $limit) {
        //consulta
        $sql = "SELECT 
        c.id as id, c.nombre as nombre, c.letra as letra, c.ruta as ruta, 
        al.nombre as album_nombre, al.ruta as album_ruta, 
        art.nombre as artista_nombre, art.descripcion as artista_descripcion, art.ruta as artista_ruta, art.slug as artista_slug, 	
        COALESCE(SUM(p.puntuacion), 0) as puntuacion_total, COUNT(p.puntuacion) as numero_votos,
        IF(p.id IS NULL,0,1) as fav
    FROM canciones c
    LEFT JOIN albumes al
        ON c.album_id = al.id
    LEFT JOIN artistas art
        ON al.artista_id = art.id
    LEFT JOIN puntuaciones p
        ON c.id = p.cancion_id
    WHERE art.id='$idArtista'
        GROUP BY c.id
    ORDER BY puntuacion_total DESC
    LIMIT $limit";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una canción por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarDTOPorSlugArtistaSlugAlbum ($conn, $slugArtista, $slugAlbum) {
        //consulta
        $sql = "SELECT 
        c.id as id, c.nombre as nombre, c.letra as letra, c.ruta as ruta, 
        al.nombre as album_nombre, al.ruta as album_ruta, 
        art.nombre as artista_nombre, art.descripcion as artista_descripcion, art.ruta as artista_ruta, art.slug as artista_slug, 	COALESCE(SUM(p.puntuacion), 0) as puntuacion_total, COUNT(p.puntuacion) as numero_votos 
    FROM canciones c
    LEFT JOIN albumes al
        ON c.album_id = al.id
    LEFT JOIN artistas art
        ON al.artista_id = art.id
    LEFT JOIN puntuaciones p
        ON c.id = p.cancion_id
    WHERE art.slug='$slugArtista' AND al.slug='$slugAlbum'
        GROUP BY c.id;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una canción por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarDTOPorSlugArtistaSlugAlbumOrdenadoPorPuntuacion ($conn, $slugArtista, $slugAlbum) {
        //consulta
        $sql = "SELECT 
        c.id as id, c.nombre as nombre, c.letra as letra, c.ruta as ruta, 
        al.nombre as album_nombre, al.ruta as album_ruta, 
        art.nombre as artista_nombre, art.descripcion as artista_descripcion, art.ruta as artista_ruta, art.slug as artista_slug, 	
        COALESCE(SUM(p.puntuacion), 0) as puntuacion_total, 
        COUNT(p.puntuacion) as numero_votos,
        IF(p.id IS NULL,0,1) as fav
    FROM canciones c
    LEFT JOIN albumes al
        ON c.album_id = al.id
    LEFT JOIN artistas art
        ON al.artista_id = art.id
    LEFT JOIN puntuaciones p
        ON c.id = p.cancion_id
    WHERE art.slug='$slugArtista' AND al.slug='$slugAlbum'
        GROUP BY c.id
        ORDER BY p.puntuacion DESC;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una canción por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPopularesPorNombreArtistaLimit ($conn, $nombre, $limit) {
        //consulta
        $sql = "SELECT 
            c.id as id, c.nombre as nombre, c.letra as letra, c.ruta as ruta, 
            al.nombre as album_nombre, al.ruta as album_ruta, 
            art.nombre as artista_nombre, art.descripcion as artista_descripcion, art.ruta as artista_ruta, art.slug as artista_slug, 	COALESCE(SUM(p.puntuacion), 0) as puntuacion_total, COUNT(p.puntuacion) as numero_votos 
        FROM canciones c
        LEFT JOIN albumes al
            ON c.album_id = al.id
        LEFT JOIN artistas art
            ON al.id = art.id
        LEFT JOIN puntuaciones p
            ON c.id = p.cancion_id
        WHERE art.nombre='$nombre'
            GROUP BY c.id
            LIMIT $limit;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una canción por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function actualizar ($conn, $id, $nombre, $albumId, $letra, $ruta) {
        //consulta
        $sql = "UPDATE canciones SET nombre='$nombre', album_id='$albumId', letra='$letra', ruta='$ruta' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar una canción por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrarPorId ($conn, $id) {
        //consulta
        $sql = "DELETE FROM canciones WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar una canción por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

}