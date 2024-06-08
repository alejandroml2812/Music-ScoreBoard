<?php

class UsuarioDTO {

    public $id;
    public $nombreUsuario;
    public $ruta;
    public $correo;

    public function __construct ($id, $nombreUsuario, $ruta, $correo) {

        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->ruta = $ruta;
        $this->correo = $correo;

    }

}