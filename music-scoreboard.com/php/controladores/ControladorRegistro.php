<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";

class ControladorRegistro
{

    public static function mostrar()
    {
        $_SESSION['actual'] = '/registro';
        if (isset($_SESSION['usuario'])) {

            header('Location:/');
        } else {

            vista('registro')->conRutasCSS([
                '/css/login.css',
                '/css/general/general.css',
                '/css/general/constantes.css',
                '/css/responsive/responsive.css'
            ])->imprimirSinFooter();
        }
    }

    public static function registrarse()
    {
        if (isset($_POST['usuarioRegistro']) && isset($_POST['correoRegistro']) && isset($_POST['contrasenaRegistro'])) {

            $usuario = trim(htmlspecialchars($_POST['usuarioRegistro']));
            $correo = trim(htmlspecialchars($_POST['correoRegistro']));
            $contrasena = trim(htmlspecialchars($_POST['contrasenaRegistro']));

            //comprobar si ya existe un usuario igual. En caso contrario continuar
            $result = ModeloUsuarios::comprobarPorUsuario($GLOBALS['conn'], $usuario);

            if ($result && mysqli_num_rows($result) > 0) {
                //si ya existe, error

                vista('registro', [
                    'error' => '409 - Conflict: El usuario ya existe, inténtelo de nuevo con otro nombre de usuario'
                ])->conRutasCSS([
                    '/css/login.css',
                    '/css/general/general.css',
                    '/css/general/constantes.css',
                    '/css/responsive/responsive.css'
                ])->imprimirSinFooter();
            } else {
                //si aun no existe, crear
                $result = ModeloUsuarios::crear($GLOBALS['conn'], $usuario, $contrasena, $correo);

                //si no hay fallos, iniciar sesion con el nuevo usuario
                if ($result) {
                    //registrado con exito, iniciar sesion con ese usuario
                    ControladorLogin::iniciarSesion(['usuarioLogin' => $usuario, 'contrasenaLogin' => $contrasena]);
                } else {
                    //error al crear el usuario
                    vista('registro', [
                        'error' => '500 - Internal Server Error: Hubo un error al crear el usuario en la base de datos. ' . mysqli_error($GLOBALS['conn'])
                    ])->conRutasCSS([
                        '/css/login.css',
                        '/css/general/general.css',
                        '/css/general/constantes.css',
                        '/css/responsive/responsive.css'
                    ])->imprimirSinFooter();
                }
            }
        } else {

            vista('registro', [
                'error' => '401 - Bad Request: El formulario no contenía todos los datos necesarios'
            ])->conRutasCSS([
                '/css/login.css',
                '/css/general/general.css',
                '/css/general/constantes.css',
                '/css/responsive/responsive.css'
            ])->imprimirSinFooter();
        }
    }

    public static function validarUsuario($usuario)
    {
        //digitos, minusculas y mayusculas. Minimo 1 caracter
        $patron = "/^[a-zA-Z0-9_]+$/";
        $validacion = preg_match($patron, $usuario);

        //entendemos que un error 'false' seria equivalente a un fracaso en la validacion '0' porque el patron deberia funcionar siempre
        return $validacion;
    }

    public static function validarContrasena($contrasena)
    {
        //digitos, minusculas y mayusculas. Minimo 1 caracter (Caracteres especiales permitidos: _-,.¡!¿?=)
        $patron = "/^[a-zA-Z0-9\_\-\,.\¡\!\¿\?\=]+$/";
        $validacion = preg_match($patron, $contrasena);

        //entendemos que un error 'false' seria equivalente a un fracaso en la validacion '0' porque el patron deberia funcionar siempre
        return $validacion;
    }

    public static function validarCorreo($correo)
    {
        //wadbj@awdbjawd.es
        $patron = "/^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/";
        $validacion = preg_match($patron, $correo);

        //entendemos que un error 'false' seria equivalente a un fracaso en la validacion '0' porque el patron deberia funcionar siempre
        return $validacion;
    }
}
