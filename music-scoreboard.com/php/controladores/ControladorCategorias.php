<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modelo/ModeloCategorias.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/CategoriaDTO.php";

class ControladorCategorias
{

    public function mostrar()
    {
        return vista('categorias/categorias')->conRutasCSS([
            '/css/categorias.css',
            '/css/responsive/responsive.css'
        ]);
    }

    public function mostrarCategoria($queryString, $slug)
    {

        $categoria = ModeloCategorias::seleccionarPorSlug($GLOBALS['conn'], $slug);
        if (mysqli_num_rows($categoria) > 0) {

            $row = mysqli_fetch_assoc($categoria);
            $id = $row['id'];
            $categoriaDTO = new CategoriaDTO($id);
            $_SESSION['actual'] = '/categorias';


            $artistasPreviewDatos = ModeloArtistas::seleccionarPorCategoriaLimit($GLOBALS['conn'], 5, $categoriaDTO->nombre);
            $artistasDTO = [];
            if (mysqli_num_rows($artistasPreviewDatos)) {
                while ($row = mysqli_fetch_assoc($artistasPreviewDatos)) {
                    $artistasDTO[] = new ArtistaDTO($GLOBALS['conn'], $row['id']);
                }
            }
            
            return vista('categorias/categoria', [
                'titulo' => 'Categoría - ' . $categoriaDTO->nombre,
                'categoriaDTO' => $categoriaDTO,
                'artistasDTO' => $artistasDTO
            ])->conRutasCSS([
                '/css/categorias.css',
                '/css/categoria.css',
                '/css/artistas.css',
                '/css/responsive/responsive.css'
            ]);
        } else {
            return vista('errores/404', [
                'error' => '404 - Not Found: La categoría que está buscando no existe',
                'categoria' => null
            ]);
        }
    }

    public function mostrarArtistas ($queryString, $categoria_slug) {

        $pagina = $queryString['pagina'] ?? 1;
        $limit = 15;

        $numeroPaginas = 0;
        $numeroPaginasDatos = ModeloArtistas::numeroPaginasPorSlugCategoria($GLOBALS['conn'], $limit, $categoria_slug);
        if (mysqli_num_rows($numeroPaginasDatos) > 0) {
            $row = mysqli_fetch_assoc($numeroPaginasDatos);
            $numeroPaginas = $row['numero_paginas'];
        }

        $artistasDatos = ModeloArtistas::seleccionarPorCategoriaLimit($GLOBALS['conn'], $limit, $categoria_slug);
        $artistasDTO = [];
        if (mysqli_num_rows($artistasDatos) > 0) {
            while ($row = mysqli_fetch_assoc($artistasDatos)) {
                $artistasDTO[] = new ArtistaDTO($GLOBALS['conn'], $row['id']);
            }
        }
        return vista('artistas/artistasPaginados', [
            'artistasDTO' => $artistasDTO,
            'numeroPaginas' => $numeroPaginas,
            'pagina' => $pagina,
            'limit' => $limit
        ])->conRutasCSS([
            '/css/artistas.css',
            '/css/artista.css',
            '/css/general/barraPaginacion.css',
            '/css/responsive/responsive.css'
        ]);

    }

}
