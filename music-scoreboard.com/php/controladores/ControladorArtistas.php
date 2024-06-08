<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/ComentarioArtistaDTO.php";

class ControladorArtistas
{

    public function mostrar($queryString)
    {

        $pagina = $queryString['pagina'] ?? 1;
        $limit = 15;

        $artistasPagina1Datos = ModeloArtistas::seleccionarPaginadoLimit($GLOBALS['conn'], $pagina, $limit);
        $artistasDTO = [];
        if (mysqli_num_rows($artistasPagina1Datos) > 0) {
            while ($row = mysqli_fetch_assoc($artistasPagina1Datos)) {
                $artistasDTO[] = new ArtistaDTO($GLOBALS['conn'], $row['id']);
            }
        }

        $numeroPaginas = 0;
        $numeroPaginasDatos = ModeloArtistas::numeroPaginas($GLOBALS['conn'], $limit);
        if (mysqli_num_rows($numeroPaginasDatos) > 0) {
            $row = mysqli_fetch_assoc($numeroPaginasDatos);
            $numeroPaginas = $row['numero_paginas'];
        }

        return vista('artistas/artistas', [
            'artistasDTO' => $artistasDTO,
            'pagina' => $pagina,
            'numeroPaginas' => $numeroPaginas,
            'limit' => $limit
        ])->conRutasCSS([
            '/css/artistas.css',
            '/css/artista.css',
            '/css/general/barraPaginacion.css',
            '/css/canciones.css',
            '/css/responsive/responsive.css'
        ]);
    }

    public function mostrarArtista ($queryString, $slug) {

        $_SESSION['actual'] = '/artistas';

        $artistaDatos = ModeloArtistas::seleccionarPorSlug($GLOBALS['conn'], $slug);
        $artistaDTO = null;
        if (mysqli_num_rows($artistaDatos) > 0) {
            $row = mysqli_fetch_assoc($artistaDatos);
            $artistaDTO = new ArtistaDTO($GLOBALS['conn'], $row['id']);
        }

        //si no se encuentra el artista, devolvemos 404
        if ($artistaDTO === null) {
            return vista('errores/404', ['error' => 'El artista solicitado no existe o no se ha encontrado']);
        }

        $cancionesDatos = ModeloCanciones::seleccionarDTOPopularesPorIdArtistaLimit($GLOBALS['conn'], $artistaDTO->id, 15);
        $cancionesDTO = [];
        if (mysqli_num_rows($cancionesDatos) > 0) {
            while ($registroCancion = mysqli_fetch_assoc($cancionesDatos)) {
                $cancionesDTO[] = new CancionDTO(
                $registroCancion['id'], $registroCancion['nombre'], $registroCancion['letra'], $registroCancion['ruta'], 
                $registroCancion['album_nombre'], $registroCancion['album_ruta'],
                $registroCancion['artista_nombre'], $registroCancion['artista_descripcion'], $registroCancion['artista_ruta'], $registroCancion['artista_slug'],
                $registroCancion['puntuacion_total'], $registroCancion['numero_votos'], $registroCancion['fav']
            );
            }
        }

        $albumesDatos = ModeloAlbumes::seleccionarPorNombreArtista($GLOBALS['conn'], $artistaDTO->nombre);
        $albumesDTO = [];
        if (mysqli_num_rows($albumesDatos) > 0) {
            while ($registroAlbum = mysqli_fetch_assoc($albumesDatos)) {
                $albumesDTO[] = new AlbumDTO($GLOBALS['conn'], $registroAlbum['id']);
            }
        }

        $comentariosDatos = ModeloComentariosArtistas::seleccionarPorSlugArtista($GLOBALS['conn'], $slug);
        $comentariosDTO = [];
        if (mysqli_num_rows($comentariosDatos) > 0) {
            while ($registroComentario = mysqli_fetch_assoc($comentariosDatos)) {
                $comentariosDTO[] = new ComentarioArtistaDTO($GLOBALS['conn'], $registroComentario['id_comentario']);
            }
        }

        //canciones DTO puede ser [] si el artista aun no tiene canciones subidas => mostrar igualmente el resto de inf.

        return vista('artistas/artista', [
            'artistaDTO' => $artistaDTO, 
            'cancionesDTO' => $cancionesDTO,
            'albumesDTO' => $albumesDTO,
            'comentariosDTO' => $comentariosDTO
            ])->conRutasCSS([
            '/css/artistas.css',
            '/css/artista.css',
            '/css/general/barraPaginacion.css',
            '/css/menusSociales.css',
            '/css/canciones.css',
            '/css/menus/menu.css',
            '/css/menus/menuComentariosCancion.css',
            '/css/menus/menuFavoritosCancion.css',
            '/css/menus/menuComentariosArtista.css',
            '/css/responsive/responsive.css',
        ]);

    }

    public function mostrarAlbum ($queryString, $slug_artista, $slug_album) {

        $_SESSION['actual'] = '/artistas';

        $cancionesDatos = ModeloCanciones::seleccionarDTOPorSlugArtistaSlugAlbumOrdenadoPorPuntuacion($GLOBALS['conn'], $slug_artista, $slug_album);
        $cancionesDTO = [];
        if (mysqli_num_rows($cancionesDatos) > 0) {
            while ($registroCancion = mysqli_fetch_assoc($cancionesDatos)) {
                $cancionesDTO[] = new CancionDTO(
                $registroCancion['id'], $registroCancion['nombre'], $registroCancion['letra'], $registroCancion['ruta'], 
                $registroCancion['album_nombre'], $registroCancion['album_ruta'],
                $registroCancion['artista_nombre'], $registroCancion['artista_descripcion'], $registroCancion['artista_ruta'], $registroCancion['artista_slug'],
                $registroCancion['puntuacion_total'], $registroCancion['numero_votos'], $registroCancion['fav']
            );
            }
        }

        $albumDatos = ModeloAlbumes::seleccionarPorSlug($GLOBALS['conn'], $slug_album);
        if ($albumDatos) {
            if (mysqli_num_rows($albumDatos) > 0) {
                $row = mysqli_fetch_assoc($albumDatos);
                $albumDTO = new AlbumDTO($GLOBALS['conn'], $row['id']);
                $artistaDTO = new ArtistaDTO($GLOBALS['conn'], $row['artista_id']);
                return vista('artistas/album', [
                    'albumDTO' => $albumDTO, 
                    'artistaDTO' => $artistaDTO,
                    'cancionesDTO' => $cancionesDTO
                    ])->conRutasCSS([
                    '/css/album.css',
                    '/css/general/barraPaginacion.css',
                    '/css/canciones.css',
                    '/css/menusSociales.css',
                    '/css/menus/menu.css',
                    '/css/menus/menuComentariosCancion.css',
                    '/css/menus/menuFavoritosCancion.css',
                    '/css/responsive/responsive.css'
                ]);
            } else {
                return vista('errores/404', ['error' => '404 - Not Found: El album solicitado no existe o no se ha encontrado']);
            }
        } else {
            return vista('errores/500', ['error' => '500 - Internal Server Error: Ha habido un error inesperado al intentar obtener el album de la base de datos']);
        }
       
    }

}