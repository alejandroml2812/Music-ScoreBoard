<?php

class FavCancionDTO {

    public $puntuacion;
    public $fav;

    public function __construct ($puntuacion, $fav) {
        $this->puntuacion = $puntuacion;
        $this->fav = $fav;
    }

}