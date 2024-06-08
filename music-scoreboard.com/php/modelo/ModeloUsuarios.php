<?php

class ModeloUsuarios
{

    public static function crear($conn, $nombre, $contrasena, $correo)
    {

        //consulta
        $sql = "INSERT INTO usuarios(nombreUsuario, contrasena, correo) VALUES ('$nombre', '$contrasena', '$correo');";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al insertar un usuario nuevo en la base de datos: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionar($conn, $id)
    {
        //consulta
        $sql = "SELECT * FROM usuarios WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un usuario por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function comprobarPorUsuario($conn, $usuario)
    {
        //consulta
        $sql = "SELECT * FROM usuarios WHERE nombreUsuario='$usuario'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un usuario por nombre de usuario: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function seleccionarPorNombre($conn, $nombre)
    {
        //consulta
        $sql = "SELECT * FROM usuarios WHERE nombreUsuario='$nombre'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al seleccionar un usuario por nombre: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function actualizar($conn, $id, $nombre, $contrasena, $correo)
    {
        //consulta
        $sql = "UPDATE  artistas SET nombreUsuario='$nombre', contrasena='$contrasena', correo='$correo' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al actualizar un usuario por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }

    public static function borrarPorId($conn, $id)
    {
        //consulta
        $sql = "DELETE FROM usuarios WHERE id='$id';";
        $result = mysqli_query($conn, $sql);

        //guardar error en sesion
        if (!$result) {
            $_SESSION['errores'][] = "Hubo un error al borrar un usuario por id: " . $conn->error;
        }

        //devuelve estado. False implica error, !false implica que se realizo con exito
        return $result;
    }
}
