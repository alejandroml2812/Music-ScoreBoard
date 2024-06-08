<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/AlbumDTO.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/ArtistaDTO.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/CancionDTO.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/DestacadoDTO.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/CancionPopularDTO.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/php/modelo/ModeloUsuarios.php";

/**
 * Imprime la vista indicada por el parámetro 'nombreVista'
 * @param nombreVista Nombre de la vista a cargar. Debe estar en la carpeta /php/vistas como hijo directo
 */
function vista($nombreVista, $parametros = null)
{
    $nombreArchivo = $nombreVista . '.php';
    $ruta = $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/$nombreArchivo";
    $vista = new Vista($ruta, $parametros);
    return $vista;
}

class Vista
{

    public $rutaPlantilla;
    public $rutasCSS = [];
    public $parametros;

    public $titulo = "Music Scoreboard";

    public $cabeceraContenido;
    public $cerrarHtmlContenido;


    public function __construct($rutaPlantilla, $parametros = null)
    {
        $this->rutaPlantilla = $rutaPlantilla;
        $this->parametros = $parametros;
        $this->actualizarPlantilla();
    }

    public function conRutasCSS($rutasCSS)
    {
        $this->rutasCSS = $rutasCSS;
        $this->actualizarPlantilla();
        return $this;
    }

    public function actualizarPlantilla()
    {
        $this->cabeceraContenido = $this->cabecera();
        $this->cerrarHtmlContenido = $this->cerrarHtml();
    }

    public function cabecera()
    {
        $resultado = "";
        $resultado .= "
        <!DOCTYPE html>
        <html lang='es'>

        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>

            <link rel='stylesheet' href='/css/general/general.css'>
            <link rel='stylesheet' href='/css/general/constantes.css'>
            <link rel='stylesheet' href='/css/general/sesion.css'>
            <link rel='stylesheet' href='/css/general/animaciones.css'>
            <link rel='stylesheet' href='/css/general/scrollbar.css'>
            <link rel='stylesheet' href='/css/general/nav.css'>
            <link rel='stylesheet' href='/css/general/vinilo.css'>
            <link rel='stylesheet' href='/css/general/fuentes.css'>
            <link rel='stylesheet' href='/css/general/footer.css'>
            <link rel='icon' type='image/x-icon' href='/img/logo.ico'>";

        //cargar archivos css añadidos con la funcion conRutasCSS
        foreach ($this->rutasCSS as $rutaCSS) {
            $resultado .= "\n<link rel='stylesheet' href='$rutaCSS'>";
        }
        $resultado .= "
            <title>$this->titulo</title>
        </head>

        <body>";
        return $resultado;
    }

    public function cerrarHtml()
    {
        return "
            </body>
        </html>
        ";
    }

    public function imprimirVista()
    {

        //variable accesible dentro de los archivos que se incluiran, entre los cuales la plantilla
        $parametros = $this->parametros;


        echo $this->cabeceraContenido;
        include($_SERVER['DOCUMENT_ROOT'] . '/php/vistas/nav.php');
        include($this->rutaPlantilla);
        include($_SERVER['DOCUMENT_ROOT'] . '/php/vistas/footer.php');
        echo $this->cerrarHtmlContenido;
       
    }

    public function imprimirSinFooter()
    {

        //variable accesible dentro de los archivos que se incluiran, entre los cuales la plantilla
        $parametros = $this->parametros;


        echo $this->cabeceraContenido;
        include($_SERVER['DOCUMENT_ROOT'] . '/php/vistas/nav.php');
        include($this->rutaPlantilla);
        echo $this->cerrarHtmlContenido;
    }

    public function imprimirPlantilla()
    {
        //variable accesible dentro de los archivos que se incluiran, entre los cuales la plantilla
        $parametros = $this->parametros;

        include($this->rutaPlantilla);
    }

    /**
     * Imprime un número determinado de categorías
     * @param conn Objecto con la conexión a la base de datos de mysqli
     * @param numero Numero de categorias a imprimir
     */
    public static function categoriasLimit($conn, $numero)
    {
        $resultado = "";
        $sql = "SELECT * FROM categorias LIMIT $numero";
        $result = mysqli_query($conn, $sql);

        //SI HAY CATEGORIAS, IMPRIMIR SECCION CATEGORIAS Y AÑADIR CADA UNA, SINO OMITIR
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $resultado .= Vista::categoria($row['nombre'], $row['slug'], $row['descripcion'], $row['ruta']);
            }
        }

        return $resultado;
    }

    /**
     * Imprime todas las categorías
     * @param conn Objecto con la conexión a la base de datos de mysqli
     */
    public static function categorias($conn): String
    {

        $resultado = "";
        $sql = "SELECT * FROM categorias";
        $result = mysqli_query($conn, $sql);

        //SI HAY CATEGORIAS, IMPRIMIR SECCION CATEGORIAS Y AÑADIR CADA UNA, SINO OMITIR
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $resultado .= Vista::categoria($row['nombre'], $row['slug'], $row['descripcion'], $row['ruta']);
            }
        }

        return $resultado;
    }

    /**
     * Imprime una categoría
     * @param nombre Nombre de la categoría
     * @param descripcion Descripción de la categoría
     * @param ruta Ruta de la imagen de presentación de la categoría
     */
    public static function categoria($nombre, $slug, $descripcion, $ruta)
    {
        $resultado = "";
        $resultado .= "\n<div class='categoria' style='background-image: url($ruta)'>";
        $resultado .= "\n   <div class='contenido oculto'>";
        $resultado .= "\n       <h2>" . $nombre . "</h2>";
        $resultado .= "\n       <p class='descripcion'>" . $descripcion . "</p>";
        $resultado .= "\n       <a class='link-card-mini' href='/categorias/$slug'>Ver</a>";
        $resultado .= "\n   </div>";
        $resultado .= "\n</div>";
        return $resultado;
    }

    /**
     * Carga de la base de datos el artista más popular e imprime sus datos
     * @param conn Objeto de mysqli con la conexión a la base de datos
     */
    public static function destacado($conn)
    {

        $resultado = "";

        //seleccionar la cancion con mayor puntuación promedio. En caso de haber varias con la misma puntuación, seleccionar
        //aleatoriamente una de ellas

        //seleccionar la cancion con mas puntuacion total. Devuelve su id, el id del artista y del album, la puntuacion total y el numero de votos
        $sql = "SELECT c.id, c.album_id, (SELECT artista_id FROM albumes WHERE albumes.id=c.album_id) AS artista_id, SUM(puntuacion) AS puntuacion_total, COUNT(p.id) AS numero_votos FROM canciones c
        LEFT JOIN puntuaciones p
        ON c.id = p.cancion_id
        GROUP BY c.id
        ORDER BY puntuacion_total DESC LIMIT 1;";

        $result = mysqli_query($conn, $sql);

        //no habra filas si no hay votos. Si hay votos devolvemos la cancion, sino, null
        if (mysqli_num_rows($result) > 0) {
            //la consulta tiene un LIMIT 1. Solo habra 1 fila
            $row = mysqli_fetch_assoc($result);
            $resultado .= Vista::destacadoVista($conn, $row['id'], $row['artista_id'], $row['album_id'], $row['puntuacion_total'], $row['numero_votos']);
        }

        return $resultado;
    }


    /** Imprime la información del destacado: Título, Artista con fondo, nombre y descripción, Album con Fondo. Usaremos un objecto DTO
     * @param id Id de la canción destacada
     * @param puntuacionTotal Puntuación total de la canción destacada
     * @param numeroVotos Número de votos de la canción destacada
     */
    public static function destacadoVista($conn, $id, $artistaId, $albumId, $puntuacionTotal, $numeroVotos)
    {

        $resultado = "";

        //datos necesarios para imprimir el contenido de destacado vienen en el objeto DTO
        $cancion = ModeloCanciones::seleccionarDTOPorIdArtista($GLOBALS['conn'], $artistaId);

        if (mysqli_num_rows($cancion) > 0) {
            $registroCancion = mysqli_fetch_assoc($cancion);
            $cancionDTO = new CancionDTO(
                $registroCancion['id'], $registroCancion['nombre'], $registroCancion['letra'], $registroCancion['ruta'], 
                $registroCancion['album_nombre'], $registroCancion['album_ruta'],
                $registroCancion['artista_nombre'], $registroCancion['artista_descripcion'], $registroCancion['artista_ruta'], $registroCancion['artista_slug'],
                $registroCancion['puntuacion_total'], $registroCancion['numero_votos'], $registroCancion['fav']
            );
            $destacado = new DestacadoDTO(
                $cancionDTO,
                new ArtistaDTO($conn, $artistaId),
                new AlbumDTO($conn, $albumId)
            );
        } else {
            $destacado = new DestacadoDTO(
                null,
                new ArtistaDTO($conn, $artistaId),
                new AlbumDTO($conn, $albumId)
            );
        }

        $puntuacion = ($puntuacionTotal !== 0) ? number_format($puntuacionTotal / $numeroVotos, 2) : 0;
        $resultado .= "\n<h2 class='titulo-seccion'>Popular</h2>";
        $resultado .= "\n<div class='album' style='background-image: url(\"" . $destacado->album->ruta . "\")'>";
        $resultado .= "\n   <div class='content'>";
        $resultado .= "\n       <div class='titulo'>";
        $resultado .= "\n           <h2>" . $destacado->artista->nombre . "</h2>";
        $resultado .= "\n           <h3>" . $destacado->album->nombre . "</h3>";
        $resultado .= "\n           <p>" . $destacado->cancion->nombre . "</p>";
        $resultado .= "\n       </div>";
        $resultado .= "\n       <a class='link-card-mini' href='/artistas/" . $destacado->artista->slug . "/" . $destacado->album->slug . "'>Ver Más</a>";
        $resultado .= "\n       <div class='puntuacion'>";
        $resultado .= "\n           <p>" . $puntuacion . "</p>";
        $resultado .= "\n           <img class='icono-pequeno' src='/img/iconos/estrella.png' alt='Icono de puntuación'>";
        $resultado .= "\n       </div>";
        $resultado .= "\n   </div>";
        $resultado .= "\n</div>";

        return $resultado;
    }

    public static function error($error)
    {

        if ($error != null) {
            $resultado = "";
            $resultado .= "\n<p class='error'>$error</p>";
            return $resultado;
        }
    }

    public static function usuario()
    {

        $resultado = "";

        $usuario = $_SESSION['usuario'];

        $resultado .= "\n<div class='usuario-perfil'>";
        $resultado .= "\n   <img src='" . $usuario->ruta . "' alt='Imagen de perfil'>";
        $resultado .= "\n   <div class='contenido'>";
        $resultado .= "\n       <p>" . $usuario->nombreUsuario . "</p>";
        $resultado .= "\n       <a class='link-card-mini' href='/logout'>Cerrar Sesión</a>";
        $resultado .= "\n   </div>";
        $resultado .= "\n</div>";

        return $resultado;
    }

    /**
     * Imprime un número determinado de artistas
     * @param conn Objecto con la conexión a la base de datos de mysqli
     * @param numero Numero de categorias a imprimir
     */
    public static function artistasLimit($conn, $numero)
    {
        $resultado = "";
        $sql = "SELECT * FROM artistas LIMIT $numero";
        $result = mysqli_query($conn, $sql);

        //SI HAY CATEGORIAS, IMPRIMIR SECCION CATEGORIAS Y AÑADIR CADA UNA, SINO OMITIR
        $numeroResultadosMostrados = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $resultado .= Vista::artista($row['nombre'], $row['descripcion'], $row['ruta']);
                $numeroResultadosMostrados++;
            }
        }

        $resultado .= Vista::artistasBarraPaginacion(0, $numero,  $numeroResultadosMostrados);

        return $resultado;
    }

    public static function artistasBarraPaginacion($paginaActual, $limit,  $numeroResultadosMostrados)
    {

        $numeroPaginas = 0;
        $sql = "SELECT COUNT(*) as numero_artistas FROM artistas;";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $numeroPaginas = round((mysqli_fetch_assoc($result)['numero_artistas'] / $limit) + 0.5);

        $resultado = "";
        $resultado .= "\n<div class='barra-paginacion'>";
        $resultado .= "\n   <label>Mostrando  $numeroResultadosMostrados resultados. Pág: " . $paginaActual + 1 . " / $numeroPaginas</label>";
        $resultado .= "\n   <ul id='barra' class='barra'>";
        for ($i = 0; $i < $numeroPaginas; $i++) {
            if ($paginaActual === $i) {
                $resultado .= "\n   <li class='actual'><button disabled id='artistas$i' onclick='cargarPagina($i, $limit)'></button></li>";
            } else {
                $resultado .= "\n   <li><button id='artistas$i' onclick='cargarPagina($i, $limit)'></button></li>";
            }
        }
        $resultado .= "\n   </ul>";
        $resultado .= "\n</div>";
        return $resultado;
    }

    public static function artista($nombre, $descripcion, $ruta)
    {
        $slug = Utilidades::generarSlug($nombre);
        $resultado = "";
        $resultado .= "\n<div class='artista' style='background-image: url($ruta)'>";
        $resultado .= "\n<div class='contenido oculto'>";
        $resultado .= "\n    <h2>$nombre</h2>";
        $resultado .= "\n    <p class='descripcion'>$descripcion</p>";
        $resultado .= "\n    <a class='link-card-mini link-card-primario' href='/artistas/$slug'>Más</a>";
        $resultado .= "\n</div>";
        $resultado .= "\n</div>";
        return $resultado;
    }

    /**
     * Imprime un número determinado de artistas en formato preview
     * @param conn Objecto con la conexión a la base de datos de mysqli
     * @param numero Numero de categorias a imprimir
     */
    public static function artistasPreviewLimit($conn, $numero)
    {
        $resultado = "";
        $sql = "SELECT * FROM artistas LIMIT $numero";
        $result = mysqli_query($conn, $sql);

        //SI HAY CATEGORIAS, IMPRIMIR SECCION CATEGORIAS Y AÑADIR CADA UNA, SINO OMITIR
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $resultado .= Vista::artistaPreview($row['nombre'], $row['ruta'], $row['slug']);
            }
        }

        return $resultado;
    }

    public static function artistaPreview($nombre, $ruta, $slug)
    {

        $slug = Utilidades::generarSlug($nombre);

        $resultado = "";
        $resultado .= "\n<a href='/artistas/$slug' class='artista' style='background-image: url($ruta)'>";
        $resultado .= "\n    <h2>$nombre</h2>";
        $resultado .= "\n</a>";
        return $resultado;
    }

    public static function footerOld()
    {
        return "
        <footer>
        <div id='links'>
          <h4>Más Información</h4>
          <ul>
            <li><a href='/informaion'>Información sobre el proyecto</a></li>
            <li><a href='/sobre-mi'>Sobre mí</a></li>
          </ul>
          <h4>Agradecimientos</h4>
          <ul>
            <li><a href='https://www.w3schools.com/' target='_blank'>W3Schools</a></li>
            <li><a href='https://ibq.es/' target='_blank'>IES Bernaldo de Quirós</a></li>
            <li><a href='https://stackoverflow.com/' target='_blank'>Stack Overflow</a></li>
          </ul>
          <h4>Mis Redes</h4>
          <ul id='redes'>
            <li><a href='https://github.com/' target='_blank'><img class='icono-mediano' src='/img/iconos/github.png' alt=''></a></li>
            <li><a href='https://x.com/' target='_blank'><img class='icono-mediano' src='/img/iconos/twitter.png' alt=''></a></li>
          </ul>
          <div id='creditos'>
            <p>Créditos</p>
            <ul>
              <li><a href='http://www.freepik.com' target='_blank'>Designed by dgim-studio / Freepik</a></li>
              <li>Imagen de <a href='https://pixabay.com/es/users/openclipart-vectors-30363/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=161282'>OpenClipart-Vectors</a> en <a href='https://pixabay.com/es//?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=161282'>Pixabay</a></li>
              <li>Imagen de <a href='https://pixabay.com/es/users/wanderercreative-855399/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=973460'>Stephanie Edwards</a> en <a href='https://pixabay.com/es//?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=973460'>Pixabay</a></li>
              <li>Imagen de <a href='https://pixabay.com/es/users/rahu-4725201/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=2912447'>Rahul Yadav</a> en <a href='https://pixabay.com/es//?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=2912447'>Pixabay</a></li>
              <li><a href='https://www.flaticon.es/iconos-gratis/favorito' title='favorito iconos'>Favorito iconos creados por Aldo Cervantes - Flaticon</a></li>
              <li><a href='https://www.flaticon.es/iconos-gratis/favorito' title='favorito iconos'>Favorito iconos creados por Aldo Cervantes - Flaticon</a></li>
            </ul>
          </div>
        </div>
        <aside>
          <div id='publicidad'>
            <h4>¿Eres compositor/a?</h4>
            <p>¡Te ayudamos a que las personas te descubran! ¿Te atreves?</p>
            <a class='link-card' href='/registro-artista'>Unirse</a>
          </div>
        </aside>
        <div id='copyright'>
          <address>Alejandro. Todos los derechos reservados &copy;, página realizada en 2024</address>
        </div>
      </footer>
        ";
    }

    public static function artistasPreviewLimitPorCategoria($conn, $limit, $nombre, $slug)
    {

        $resultado = "";

        $artistas = ModeloArtistas::seleccionarPorCategoriaLimit($conn, $limit, $nombre, $slug);
        if (mysqli_num_rows($artistas) > 0) {
            $resultado .= "<h2 class='titulo-seccion'>$nombre</h2>";
            while ($row = mysqli_fetch_assoc($artistas)) {
                $resultado .= Vista::artistaPreview($row['nombre'], $row['ruta'], $row['slug']);
            }
            $resultado .= "<a href='/categorias/$slug/artistas' class='link-card'>Ver Todos</a>";
        }

        return $resultado;
    }

    public static function misFavoritos()
    {

        $resultado = "";
        $resultado .= "\n<div class='favorito'>";
        $resultado .= "\n</div>";
        return $resultado;
    }


    public static function artistaContenido($artistaDTO)
    {
        return $artistaDTO->descripcionLarga;
    }

    public static function artistaAside($artistaDTO)
    {
        $resultado =  "";
        $resultado .= "\n<div class='imagen-contenedor' style='background-image: url(\"$artistaDTO->ruta\")'></div>";
        $resultado .= "\n<div class='aside-contenido'>";
        $resultado .= "\n   <h3 class='titulo-seccion'>Discos</h3>";
        $resultado .= "\n   <div class='discos'>";
        $resultado .= "\n" . Vista::discos($artistaDTO->nombre, $artistaDTO->slug);
        $resultado .= "\n   </div>";
        $resultado .= "\n   <h3 class='titulo-seccion'>Canciones Populares</h3>";
        $resultado .= "\n   <div class='canciones-populares'>";
        $resultado .= "\n" . Vista::cancionesPopularesLimit($artistaDTO->nombre, 5);
        $resultado .= "\n   </div>";
        $resultado .= "\n</div>";

        return $resultado;
    }

    public static function discos($nombreArtista, $slugArtista)
    {
        $resultado = "";

        $albumes = ModeloAlbumes::seleccionarPorNombreArtista($GLOBALS['conn'], $nombreArtista);
        if (mysqli_num_rows($albumes) > 0) {
            while ($row = mysqli_fetch_assoc($albumes)) {
                $ruta = $row['album_ruta'];
                $slugAlbum = $row['slug'];
                $resultado .= "\n<a href='/artistas/$slugArtista/$slugAlbum' class='disco' style='background-image: url(\"$ruta\")'>";
                $resultado .= "\n   <div class='contenido'>";
                $resultado .= "\n       <p>" . $row['album_nombre'] . "</p>";
                $resultado .= "\n   </div>";
                $resultado .= "\n</a>";
            }
        }
        return $resultado;
    }

    public static function cancionesPopularesLimit($nombre, $limit)
    {
        $resultado = "";

        $cancionesPopulares = ModeloCanciones::seleccionarPopularesPorNombreArtistaLimit($GLOBALS['conn'], $nombre, $limit);

        $i = 0;
        if (mysqli_num_rows($cancionesPopulares) > 0) {
            while ($row = mysqli_fetch_assoc($cancionesPopulares)) {
                $cancionPopularDTO = new CancionPopularDTO(...$row);
                if ($cancionPopularDTO->numero_votos != 0) {
                    $puntuacion = number_format($cancionPopularDTO->puntuacion_total / $cancionPopularDTO->numero_votos, 2);
                } else {
                    $puntuacion = 0;
                }
                $resultado .= "\n       <ul class='cancion-popular'>";
                $resultado .= "\n           
                <li>
                    <h2 class='cancion-artista'><img src='$cancionPopularDTO->album_ruta' alt=''></h2>
                    <h3>$cancionPopularDTO->album_nombre</h3>
                    <p>$cancionPopularDTO->nombre</p>
                    <p class='puntuacion'>
                        <label>" . $puntuacion . "</label>
                        <button class='accion-boton' onclick='mostrarMenuFavoritos(\"$cancionPopularDTO->id\", \"menu_cancion_$i\")'>
                            <img class='icono-pequeno' src='/img/iconos/estrella.png' alt=''>
                        </button>
                        <button class='accion-boton' onclick='mostrarMenuComentariosCancion(\"$cancionPopularDTO->id\", \"menu_cancion_$i\")'>
                            <img class='icono-pequeno' src='/img/iconos/comentario.png' alt='Comentar'>
                        </button>
                    </p>
                    <div id='menu_cancion_$i' class='menu oculto'></div>
                </li>";
                $resultado .= "\n       </ul>";
                $i++;
            }
        }
        return $resultado;
    }
}
