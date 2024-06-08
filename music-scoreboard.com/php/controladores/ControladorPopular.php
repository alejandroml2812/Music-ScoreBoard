<?php

class ControladorPopular {

    public function mostrar () {

        $categoriasDatos = ModeloCategorias::seleccionarPopularesLimit($GLOBALS['conn'], 6);
        $categoriasDTO = [];
        if (mysqli_num_rows($categoriasDatos) > 0) {
            while ($row = mysqli_fetch_assoc($categoriasDatos)) {
                $categoriaDTO = new CategoriaDTO($row['id_categoria']);
                $puntuacionTotal = $row['puntuacion_total'];
                $categoriasDTO[] = [
                    'categoriaDTO' => $categoriaDTO,
                    'puntuacion_total' => $puntuacionTotal
                ];
            }
        }

        $albumesDatos = ModeloAlbumes::seleccionarPopularesLimit($GLOBALS['conn'], 6);
        $albumesDTO = [];
        if (mysqli_num_rows($albumesDatos) > 0) {
            while ($row = mysqli_fetch_assoc($albumesDatos)) {
                $albumDTO = new AlbumDTO($GLOBALS['conn'], $row['id']);
                $artistaDTO = new ArtistaDTO($GLOBALS['conn'], $row['artista_id']);
                $albumesDTO[] = [
                    'albumDTO' => $albumDTO,
                    'puntuacionTotal' => $row['puntuacion_total'],
                    'artistaDTO' => $artistaDTO
                ];
            }
        }

        $artistasDatos = ModeloArtistas::seleccionarPopularesLimit($GLOBALS['conn'], 6);
        $artistasDTO = [];
        if (mysqli_num_rows($artistasDatos) > 0) {
            while ($row = mysqli_fetch_assoc($artistasDatos)) {
                $artistaDTO = new ArtistaDTO($GLOBALS['conn'], $row['id']);
                $artistasDTO[] = [
                    'artistaDTO' => $artistaDTO,
                    'puntuacionTotal' => $row['puntuacion_total']
                ];
            }
        }

        return vista('popular', [
            'categoriasDTO' => $categoriasDTO,
            'albumesDTO' => $albumesDTO,
            'artistasDTO' => $artistasDTO
        ])->conRutasCSS([
            '/css/artistas.css',
            '/css/artista.css',
            '/css/index.css',
            '/css/categorias.css',
            '/css/artista.css',
            'css/discos.css',
            'css/popular.css',
            '/css/responsive/responsive.css',
        ]);

    }

}