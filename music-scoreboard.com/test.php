<?php

//conexion a bd. Si no se consigue, parar el script php. Guardamos la conexion como acceso global
$conn = mysqli_connect("localhost", "root", "r8Hl5OuZNNr1ilB", "music_scoreboard_com");
if (!$GLOBALS['conn']) {
  die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$artista = "50 Cent";
$idEmpezar = 97;
$ids = $idEmpezar.", ".($idEmpezar+1).", ".($idEmpezar+2);

$sql = "SELECT nombre FROM albumes WHERE id>='$idEmpezar' AND id<$idEmpezar+3;";
$result = mysqli_query($conn, $sql);
$albumes = "";
while ($row = mysqli_fetch_assoc($result)) {
    $albumes .= $row['nombre'] . ",\t";
}

$ia = "INSERT para agregar las canciones de los álbumes $albumes de $artista a una tabla 
con el esquema (nombre, album_id) donde los album_id son $ids respectivamente:";

echo $ia;
