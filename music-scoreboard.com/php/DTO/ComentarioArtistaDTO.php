<?php

class ComentarioArtistaDTO {

    //mostraremos un usuario con su imagen y nombre de usuario, ademas de su comentario
    public $id;
    public $usuario_nombre;
    public $usuario_ruta;
    public $comentario;
    public $fav;
    public $numeroFavs;

    public function __construct ($conn, $id) {

        $comentarioDatos = ModeloComentariosArtistas::seleccionar($conn, $id);
        if (mysqli_num_rows($comentarioDatos) > 0) {
            $registroComentario = mysqli_fetch_assoc($comentarioDatos);
            $this->id = $registroComentario['id_comentario'];
            $usuarioId = $registroComentario['id_usuario'];
            $this->comentario = $registroComentario['comentario'];

            $usuarioDatos = ModeloUsuarios::seleccionar($GLOBALS['conn'], $usuarioId);
            if (mysqli_num_rows($usuarioDatos) > 0) {
                $registroUsuario = mysqli_fetch_assoc($usuarioDatos);
                $this->usuario_nombre = $registroUsuario['nombreUsuario'];
                $this->usuario_ruta = $registroUsuario['ruta'];

                $favDatos = ModeloLikesComentariosArtistas::seleccionarFavPorIdComentario($GLOBALS['conn'], $registroUsuario['id'], $registroComentario['id_comentario']);
                if (mysqli_num_rows($favDatos) > 0) {
                    $registroFav = mysqli_fetch_assoc($favDatos);
                    $this->fav = $registroFav['fav'];
                    $this->numeroFavs = $registroFav['numero_favs'];
                }
            }
        }
    }

}