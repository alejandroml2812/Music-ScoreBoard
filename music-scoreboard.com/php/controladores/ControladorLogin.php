<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/vistas/Vista.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/DTO/UsuarioDTO.php";

class ControladorLogin
{

    public static function mostrar()
    {

        $_SESSION['actual'] = '/login';
        if (isset($_SESSION['usuario'])) {

            header('Location:/');

        } else {

            vista('login')->conRutasCSS([
                '/css/login.css',
                '/css/general/general.css',
                '/css/general/constantes.css',
                '/css/responsive/responsive.css'
            ])->imprimirSinFooter();

        }

    }

    public static function iniciarSesion($queryString)
    {

        //usamos trim y htmlspecialchars para sanitizar la entrada de datos desde el formulario
        $usuario = trim(htmlspecialchars($queryString['usuarioLogin']));
        $contrasena = trim(htmlspecialchars($queryString['contrasenaLogin']));

        //validacion de los datos de inicio de sesión
        if ($usuario != null && $contrasena != null) {
            //datos validos, comprobar ahora el inicio de sesion

            //VALIDAR USUARIO
            $sql = "SELECT * FROM usuarios WHERE nombreUsuario='$usuario' AND contrasena='$contrasena'";
            $result = mysqli_query($GLOBALS['conn'], $sql);

            //si existe el usuario y se aciertan los datos
            if (mysqli_num_rows($result) > 0) {
                $usuarioResult = ModeloUsuarios::seleccionarPorNombre($GLOBALS['conn'], $usuario);
                $row = mysqli_fetch_assoc($usuarioResult);
                $_SESSION['usuario'] = new UsuarioDTO($row['id'], $row['nombreUsuario'], $row['ruta'], $row['correo']);
                header('Location:/');
                exit;
            } else {

                vista('login', [
                    'error' => '401 - Unauthorized Access: Los datos de inicio de sesión son incorrectos, inténtelo de nuevo'
                ])->conRutasCSS([
                    '/css/login.css',
                    '/css/general/general.css',
                    '/css/general/constantes.css',
                    '/css/responsive/responsive.css'
                ])->imprimirSinFooter();

            }
        } else {
            //datos no validos. Devolvemos error 400 Bad Request (la validacion del form en el lado cliente no ha funcionado)
            vista('login', [
                'error' => '400 - Bad Request: Los datos recibidos (usuario o contraseña) no son válidos. Revise el formulario e inténtelo de nuevo'
            ])->conRutasCSS([
                '/css/login.css',
                '/css/general/general.css',
                '/css/general/constantes.css',
                '/css/responsive/responsive.css'
            ])->imprimirSinFooter();
        }
    }

    public static function cerrarSesion () {
        setcookie(session_name(), '', 100);
        session_unset();
        session_destroy();
        $_SESSION = array();
        header("Location:/");
    }

    public static function validarUsuario($usuario)
    {
        //digitos, minusculas y mayusculas. Minimo 1 caracter
        $patron = "/^[a-zA-Z0-9]+$/";
        $validacion = preg_match($patron, $usuario);

        //entendemos que un error 'false' seria equivalente a un fracaso en la validacion '0' porque el patron deberia funcionar siempre
        return $validacion;
    }

    public static function validarContrasena($contrasena)
    {
        //digitos, minusculas y mayusculas. Minimo 8 caracteres (excluimos caracteres especiales, pero se podrian implementar para mayor seguridad)
        $patron = "/[a-zA-Z0-9]{8,}/";
        $validacion = preg_match($patron, $contrasena);

        //entendemos que un error 'false' seria equivalente a un fracaso en la validacion '0' porque el patron deberia funcionar siempre
        return $validacion;
    }
}
