<?php

$links = [
    'inicio' => [
        'texto' => 'Inicio',
        'descripcion' => 'Página principal donde ver un resumen de las categorías, y el destacado actual',
        'ruta' => '/'
    ],
    'categorias' => [
        'texto' => 'Categorías',
        'descripcion' => 'Página donde explorar todas las categorías disponibles, utilizando filtros y barra de búsqueda',
        'ruta' => '/categorias'
    ],
    'artistas' => [
        'texto' => 'Artistas',
        'descripcion' => 'Página donde consultar los artistas ordenados por diferentes criterios: género, popularidad...',
        'ruta' => '/artistas'
    ],
    'popular' => [
        'texto' => 'Popular',
        'descripcion' => 'Página donde ver las últimas tendencias: destacado, artistas populares, discos que lo están \'petando\', etc.',
        'ruta' => '/popular'
    ]
];

?>
<nav>
    <ul class='links'>
<?php
foreach ($links as $link) {
    $actual = (isset($_SESSION['actual'])) ? $_SESSION['actual'] : null;
    $esActual = ($actual === $link['ruta']);
    $clase = ($esActual) ? 'class=\'actual\'' : '';
?>
    <li>
        <a <?=$clase?> href="<?=$link['ruta']?>"><?=$link['texto']?></a>
    </li>
<?php
}
?>
    </ul>
<?php
//si no se ha iniciado sesion, mostrar botones para iniciar
if (!isset($_SESSION['usuario'])) {

    //en /login y /registro omitir este minimenu de inicio/registro
    if ($_SESSION['actual'] !== '/login' && $_SESSION['actual'] !== '/registro') {
?>
    <div class='usuario-perfil'>
        <img src="/storage/imagenes_perfil/predeterminado.png" alt="Imagen de perfil">
        <div class='contenido'>
            <a class='link-card-mini' href="/login">Iniciar Sesión</a>
            <a class='link-card-mini' href="/registro">Registro</a>
        </div>
    </div>
<?php
    }
    //si si se ha iniciado, mostrar informacion del usuario
} else {
    include($_SERVER['DOCUMENT_ROOT'] . '/php/vistas/usuario/usuarioLogin.php');
}
?>
</nav>