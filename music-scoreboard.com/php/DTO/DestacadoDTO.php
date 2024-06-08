<?php

class DestacadoDTO {

    public $cancion;
    public $artista;
    public $album;

    function __construct ($cancion, $artista, $album) {
        $this->cancion = $cancion;
        $this->artista = $artista;
        $this->album = $album;
    }

}