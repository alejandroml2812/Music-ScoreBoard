<?php

class ModeloArtistas
{

    public static function crear($conn, $nombre, $categoriaId, $descripcion)
    {
        //consulta
        $sql = "INSERT INTO artistas(nombre, categoria_id, descripcion) VALUES ($nombre, $categoriaId, $descripcion);";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar un artista nuevo en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar($conn, $id)
    {
        //consulta
        $sql = "SELECT * FROM artistas WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un artista por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPopularesLimit($conn, $limit)
    {
        //consulta
        $sql = "SELECT art.id as id, SUM(p.puntuacion) as puntuacion_total FROM artistas art 
LEFT JOIN albumes al 
ON al.artista_id = art.id 
LEFT JOIN canciones c 
on c.album_id = al.id
LEFT JOIN puntuaciones p 
ON p.cancion_id = c.id
WHERE p.puntuacion IS NOT NULL
GROUP BY art.id
ORDER BY puntuacion_total DESC LIMIT $limit;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar los artistas mas populares por votacion de canciones por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPaginadoLimit($conn, $pagina, $limit)
    {
        //consulta
        $offset = ($pagina - 1) * $limit;
        $sql = "SELECT * FROM artistas LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar artistas de forma paginada: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function numeroPaginas($conn, $limit)
    {
        //consulta
        $sql = "SELECT ROUND( COUNT(*) / $limit + 0.5) as numero_paginas FROM artistas;";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar el número de páginas: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function numeroPaginasPorSlugCategoria($conn, $limit, $slug)
    {
        //consulta
        $sql = "SELECT ROUND( COUNT(*) / $limit + 0.5) as numero_paginas FROM artistas WHERE categoria_id=(SELECT id FROM categorias WHERE slug='$slug');";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar el número de páginas: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorNombre($conn, $nombre)
    {
        //consulta
        $sql = "SELECT * FROM artistas WHERE nombre='$nombre'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un artista por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorSlug($conn, $slug)
    {
        //consulta
        $sql = "SELECT * FROM artistas WHERE slug='$slug'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un artista por slug: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorCategoria($conn, $nombre)
    {

        $categoria = ModeloCategorias::seleccionarPorNombre($conn, $nombre);
        $result = null;

        if (mysqli_num_rows($categoria) > 0) {
            $row = mysqli_fetch_assoc($categoria);
            $id = $row['id'];
            $sql = "SELECT * FROM artistas WHERE categoria_id='$id';";
            $result = mysqli_query($conn, $sql);
        } else {
            $_SESSION['errores'][] = "Hubo un error al obtener los artistas de la categoría '$nombre': " . $conn->error;
        }

        return $result;
    }

    public static function seleccionarPorCategoriaLimit($conn, $limit, $nombre)
    {

        $categoria = ModeloCategorias::seleccionarPorNombre($conn, $nombre);
        $result = null;

        if (mysqli_num_rows($categoria) > 0) {
            $row = mysqli_fetch_assoc($categoria);
            $id = $row['id'];
            $sql = "SELECT * FROM artistas WHERE categoria_id='$id' LIMIT $limit;";
            $result = mysqli_query($conn, $sql);
        } else {
            $_SESSION['errores'][] = "Hubo un error al obtener la categoría del artista por nombre: " . $conn->error;
        }

        return $result;
    }

    public static function actualizar($conn, $id, $nombre, $categoriaId, $descripcion)
    {
        //consulta
        $sql = "UPDATE artistas SET nombre='$nombre', categoria_id='$categoriaId', descripcion='$descripcion' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar un artista por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrarPorId($conn, $id)
    {
        //consulta
        $sql = "DELETE FROM artistas WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar un artista por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }
}
