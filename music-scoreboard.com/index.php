<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/Router.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorIndex.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorCategorias.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorLogin.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorRegistro.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorArtistas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorPuntuaciones.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorComentarios.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorComentariosCanciones.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorComentariosArtistas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorPlantillas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorCanciones.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/controladores/ControladorPopular.php';

//iniciar una sesion 
session_start();

//conexion a bd. Si no se consigue, parar el script php. Guardamos la conexion como acceso global
$GLOBALS['conn'] = mysqli_connect("localhost", "root", "r8Hl5OuZNNr1ilB", "music_scoreboard_com");
if (!$GLOBALS['conn']) {
  die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

//enrutador
$router = new Router();

//Rutas de paginas

//index
$router->get('/', 'ControladorIndex@mostrar');

//Categorias
$router->get('/categorias','ControladorCategorias@mostrar');
$router->get('/categorias/{slug}', 'ControladorCategorias@mostrarCategoria');
$router->get('/categorias/{categoria_slug}/artistas', 'ControladorCategorias@mostrarArtistas');

//login
$router->get('/login', 'ControladorLogin@mostrar');
$router->post('/login', 'ControladorLogin@iniciarSesion');
$router->get('/logout', 'ControladorLogin@cerrarSesion');

//registro
$router->get('/registro', 'ControladorRegistro@mostrar');
$router->post('/registro', 'ControladorRegistro@registrarse');

//artistas
$router->get('/artistas', 'ControladorArtistas@mostrar');
$router->get('/artistas/{slug}', 'ControladorArtistas@mostrarArtista');

//discos
$router->get('/artistas/{slug_artista}/{slug_album}', 'ControladorArtistas@mostrarAlbum');

//popular
$router->get('/popular', 'ControladorPopular@mostrar');

//Rutas API REST (pensadas para utilizar desde el lado cliente con peticiones con fetch o ajax/xmlhttprequest)
$router->post('/api/votar-cancion', 'ControladorPuntuaciones@votarCancion');
$router->get('/api/canciones/{id}/comentarios', 'ControladorComentariosCanciones@comentariosCancion');
$router->post('/api/comentar-cancion', 'ControladorComentariosCanciones@comentarCancion');
$router->post('/api/like-comentario', 'ControladorComentariosCanciones@darLikeComentario');
$router->get('/api/plantillas/favoritos-cancion', 'ControladorPlantillas@plantillaFavoritosCancion');
$router->get('/api/plantillas/comentarios', 'ControladorPlantillas@plantillaComentarios');
$router->get('/api/canciones/{id}', 'ControladorCanciones@apiCancion');
$router->post('/api/comentar', 'ControladorComentarios@comentar');
$router->post('/api/dar-like', 'ControladorComentarios@darLike');
$router->post('/api/plantillas/comentario', 'ControladorComentarios@plantilla');

//Ejecuta el enrutamiento. Devuelve la llamada al controlador apropiado segun la peticion. El controlador se encargara de obtener los
//datos necesarios desde el modelo y de devolver la vista utilizando llamadas a la vist, siguiendo el patrón Modelo-Vista-Controlador (MVC)
$router->ejecutar();
?>