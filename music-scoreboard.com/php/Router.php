<?php

class Router
{

    private $rutas = array();
    private $acciones = array();
    private $metodos = array();

    /**
     * Añade una ruta a la lista de rutas. Se asocia una URI con una acción (llamada a una función) y con un método HTTP (GET, POST...)
     * @param ruta Uri de la ruta que añadimos
     * @param accion Acción (método o función) a llamar cuando se visita la ruta
     * @param metodo Método HTTP utilizado en la petición
     */
    public function crear($ruta, $accion, $metodo = "GET")
    {
        $this->rutas[] = '/' . trim($ruta, '/');

        if ($accion != null) {
            $this->acciones[] = $accion;
        }

        $this->metodos[] = $metodo;
    }

    /**
     * Añade una ruta de tipo GET
     */
    public function get($ruta, $accion = null)
    {
        $this->crear($ruta, $accion, "GET");
    }

    /**
     * Añade una ruta de tipo POST
     */
    public function post($ruta, $accion = null)
    {
        $this->crear($ruta, $accion, "POST");
    }

    public function ejecutar()
    {

        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        $rutaExiste = false;

        //en cualquier caso, guardar en la variable $parametrosURL los parametros GET recibidos y dejar la ruta
        //sin esos parametros
        switch ($metodo) {
            case "GET":
                $queryString = parse_url($uri, PHP_URL_QUERY);
                parse_str($queryString, $parametrosUrl);
                $uri = explode('?', $uri)[0];
                break;
            case "POST":
                $parametrosUrl = $_POST;
                break;
        }

        //buscar en el array de rutas a ver cual coincide con la uri. En caso de no coincidir ninguna, devolvemos 404
        foreach ($this->rutas as $key => $value) {

            $patronParametro = "/{[a-zA-Z0-9_-]+}/"; // Ejemplo de ruta generica: /categorias/{nombre}

            //solo si la ruta contiene parametros genericos
            if (preg_match($patronParametro, $value)) {

                //parametros array para cada elemento {param} dentro de una ruta. Ejemplo: /categorias/{nombre} => nombre = parametro
                //en array parametros guardar indice del parametro, nombre y valor.
                $parametros = [];

                //analizar subrutas de la ruta generica en busca de parametros. Ej: /categorias/{nombre}
                $subRutas = array_slice(explode('/', $value), 1);
                for ($i = 0; $i < count($subRutas); $i++) {
                    if ($subRutas[$i] !== '') {
                        if (preg_match($patronParametro, $subRutas[$i])) {
                            $parametros[] = [
                                'texto' => $subRutas[$i],
                                'indice' => $i,
                                'valor' => ''
                            ];
                        }
                    }
                }

                //si el explode de las rutas no tiene la misma longitud, son distintas seguro
                if (count(array_slice(explode('/', $uri), 1)) !== count(array_slice(explode('/', $value), 1))) {
                    continue;
                }

                //analizar la ruta especifica en busca de asignacion de parametros al array previamente creado.
                /*
                    Como comparar ruta especifica: /categorias/rap con ruta generica: /categorias/{nombre} para saber si son equivalentes?
                    hacer array_slice(explode('/'),1) de ambas rutas: [categorias, rap], [categorias, {nombre}]
                    eliminar del array generico los parametros y obtener el indice para eliminar del otro array el elemento en ese indice
                    [categorias], [categorias]
                    si ambos arrays son exactamente iguales termino a termino, las rutas son equivalentes
                */
                $rutaGenerica = $value;

                //guardar substring de la uri desde el inicio hasta la aparicion del simbolo '?' (indicando parametros GET)
                $rutaEspecifica = strtok($uri, '?');

                $rutaGenericaArray = array_slice(explode('/', $rutaGenerica), 1);
                $rutaEspecificaArray = array_slice(explode('/', $rutaEspecifica), 1);

                $claves = array_keys($rutaGenericaArray);
                for ($j = 0; $j < count($claves); $j++) {

                    if (preg_match($patronParametro, $rutaGenericaArray[$claves[$j]])) {
                        unset($rutaGenericaArray[$claves[$j]]);
                        unset($rutaEspecificaArray[$claves[$j]]);
                    }

                }


                $equivalentes = true;
                $claves = array_keys($rutaGenericaArray);
                for ($i = 0; $i < count($claves); $i++) {
                    if ($rutaGenericaArray[$claves[$i]] !== $rutaEspecificaArray[$claves[$i]]) {
                        $equivalentes = false;
                    }
                }

                if ($equivalentes) {

                    $subRutasUri = array_slice(explode('/', $uri), 1);
                    for ($i = 0; $i < count($parametros); $i++) {
                        $parametros[$i]['valor'] = $subRutasUri[$parametros[$i]['indice']];
                    }

                    //modificar la url generica para convertirla en especifica. Asi podremos comprobar despues si son iguales o no
                    /*
                    $uriGenericaValoresAplicados = $value;
                    for ($i = 0; $i < count($parametros); $i++) {
                        $uriGenericaValoresAplicados = str_replace($parametros[$i]['texto'], $parametros[$i]['valor'], $uriGenericaValoresAplicados);
                    }
                    */
                    
                    //ya sabemos que son equivalentes, solo queda comprobar el metodo GET/POST
                    if ($metodo === $this->metodos[$key]) {
                        $_SESSION['actual'] = $uri;
                        $accion = $this->acciones[$key];

                        $this->ejecutarAccion($accion, $this->parsearParametros($parametros), $parametrosUrl);
                        $rutaExiste = true;
                        exit;
                    }

                } else {
                    continue;
                }
            } else {

                //la ruta no tiene parametros genericos, buscar match
                // buscar equivalencia /categorias/Rap con /categorias/{nombre}

                if (preg_match("#^$value$#", $uri) && $metodo === $this->metodos[$key]) {
                    $_SESSION['actual'] = $uri;
                    $accion = $this->acciones[$key];
                    $this->ejecutarAccion($accion, [], $parametrosUrl);
                    $rutaExiste = true;
                    exit;
                }
            }
        }

        if (!$rutaExiste) {
            vista('errores/404', ['error' => '404 - Not Found: La página solicitada no existe'])->conRutasCSS([
                '/css/general/error.css'
            ])->imprimirVista();
        }
    }

    private function ejecutarAccion($accion, $parametrosRuta, $queryString)
    {
        if ($accion instanceof \Closure) {

            $resultado = $accion($queryString, ...$parametrosRuta);
            if ($resultado instanceof Vista) {
                $resultado->imprimirVista();
            } else {
                echo $resultado;
            }
        } else {

            $params = explode('@', $accion);
            $obj = new $params[0];
            $resultado = $obj->{$params[1]}($queryString, ...$parametrosRuta);
            if ($resultado instanceof Vista) {
                $resultado->imprimirVista();
            } else {
                echo $resultado;
            }

        }
    }

    /**
     * Devuelv un array de la forma clave => valor en base a los datos importantes del array de entrada
     * @param parametros Array con parametros analizados en la uri. Cada entrada tiene texto, indice y valor
     */
    private function parsearParametros($parametros)
    {
        $resultado = [];
        for ($i = 0; $i < count($parametros); $i++) {
            $clave = str_replace(['{', '}'], ['', ''], $parametros[$i]['texto']);
            $valor = $parametros[$i]['valor'];
            $resultado[$clave] = $valor;
        }
        return $resultado;
    }
}
