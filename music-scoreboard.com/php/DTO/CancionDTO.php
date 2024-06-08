<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/Utilidades.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/modelo/ModeloCanciones.php";

class CancionDTO {

    public $id;
    public $nombre;
    public $letra;
    public $ruta;
    public $album_nombre;
    public $album_ruta;
    public $artista_nombre;
    public $artista_descripcion;
    public $artista_ruta;
    public $artista_slug;
    public $puntuacion_total;
    public $numero_votos;
    public $fav;


    public function __construct ($id, $nombre, $letra, $ruta, $album_nombre, $album_ruta, $artista_nombre, $artista_descripcion, $artista_ruta, $artista_slug, $puntuacion_total, $numero_votos, $fav) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->letra = $letra;
        $this->ruta = $ruta;
        $this->album_nombre = $album_nombre;
        $this->album_ruta = $album_ruta;
        $this->artista_nombre = $artista_nombre;
        $this->artista_descripcion = $artista_descripcion;
        $this->artista_ruta = $artista_ruta;
        $this->artista_slug = $artista_slug;
        $this->puntuacion_total = $puntuacion_total;
        $this->numero_votos = $numero_votos;
        $this->fav = $fav;
    }

}