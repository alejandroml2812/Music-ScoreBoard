<?php

class ModeloCategorias {

    public static function crear ($conn, $nombre, $descripcion, $ruta, $slug) {
        //consulta
        $sql = "INSERT INTO categorias(nombre, descripcion, ruta, slug) VALUES ('$nombre', '$descripcion', '$ruta', '$slug');";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar una categoría nueva en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar ($conn, $id) {
        //consulta
        $sql = "SELECT * FROM categorias WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una categoría por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPopularesLimit ($conn, $limit) {
        //consulta
        $sql = "SELECT cat.id as id_categoria, SUM(p.puntuacion) AS puntuacion_total FROM puntuaciones p 
        LEFT JOIN canciones c 
        ON p.cancion_id = c.id
        LEFT JOIN albumes al
        ON c.album_id = al.id 
        LEFT JOIN artistas art 
        ON al.artista_id=art.id 
        LEFT JOIN categorias cat 
        ON art.categoria_id = cat.id
        GROUP BY cat.nombre
        ORDER BY puntuacion_total DESC LIMIT $limit";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una categoría por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorNombre ($conn, $nombre) {
        //consulta
        $sql = "SELECT * FROM categorias WHERE nombre='$nombre'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una categoría por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorSlug ($conn, $slug) {
        //consulta
        $sql = "SELECT * FROM categorias WHERE slug='$slug'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar una categoría por slug: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function actualizar ($conn, $id, $nombre, $descripcion, $ruta, $slug) {
        //consulta
        $sql = "UPDATE canciones SET nombre='$nombre', descripcion='$descripcion', ruta='$ruta', slug='$slug' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar una categoría por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrarPorId ($conn, $id) {
        //consulta
        $sql = "DELETE FROM categorias WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar una categoría por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

}