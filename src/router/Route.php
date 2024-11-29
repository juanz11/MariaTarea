<?php
/*PASO 51 diseñamos la clase que nos permite registar las URL en sus respectivos metodos*/
class Route {

    public function __construct() {//definimos un construtor 
        
    }

    private static $uris = array(); //en esta variables vamos a registras las URL
    /*
    URI (Uniform Resource Identifier, “Identificador uniforme de recursos”)
    identifica un recurso por su nombre, por su ubicación o por ambos. 
    En este último caso, el URI indica que un recurso identificado y dónde está disponible.
    
    URL significa Uniform Resource Locator (Localizador de Recursos Uniforme). Una URL no
    es más que una dirección que es dada a un recurso único en la Web. En teoria, cada URL 
    válida apunta a un único recurso. 

    dentro de nuestros proyecto usamor URIs para indentificale a cada operacion donde estan los recursos
    que necesita para funcionar, mientras que el navegador hace uso de las URL para ubicar dicho recurso en la web.

    Cave señalar que la URL es un TIPO de URI
    */

    public static function add($method, $uri, $function = null) {

        Route::$uris[] = new Uri(self::parseUri($uri), $method, $function);
        //limpiarmos la ruta URI con el metodo parseURI al instanciar
        //intanciamos una nueva clase Uri PASO 53 ./src/router/Uri.php
        //Retornará un Middleware...Conviene investigar a profundidad
        /*es una capa de software que conecta el sistema operativo con las aplicaciones, los datos y los usuarios
        Tambien se puede decir que es una capa de seguridad, donde evaluamos las reglas necesarias de acceso a los usuarios.*/
        return;
    }

  //definimos los metodos que establecen el metodo por el cual se reciben las peticiones en nuestro sistema

    public static function get($uri, $function = null) {
        return Route::add("GET", $uri, $function);
    }

    public static function post($uri, $function = null) {
        return Route::add("POST", $uri, $function);
    }

    public static function put($uri, $function = null) {
        return Route::add("PUT", $uri, $function);
    }

    public static function delete($uri, $function = null) {
        return Route::add("DELETE", $uri, $function);
    }

    public static function any($uri, $function = null) {
        return Route::add("ANY", $uri, $function);
    }



    //paso 54
    private static function parseUri($uri) { //metodo para limpiar las uri recibidas

        $uri = trim($uri, '/'); //eliminamos da la URI el caracter /

        $uri = (strlen($uri) > 0) ? $uri : '/';
        //ahora si al momento de limpiar la ruta base ( / ) queda sin elementos pues se iguala a la ruta base
        return $uri;
    }

   
    //PASO 55
    public static function submit() {//ejecutamos la busqueda que el usuario esta buscando por medio de la URL

        $method = $_SERVER['REQUEST_METHOD'];//obtenemos el metodo por el cual se hace la peticion

        $uri = isset($_GET['uri']) ? $_GET['uri'] : ''; //obtenemos la URI de redirecion

        $uri = self::parseUri($uri);//parseamos la URI

        //Verifica si la uri que está pidiendo el usuario se encuentra registrada...
        foreach (Route::$uris as $key => $recordUri) { 
            /*mediante una busqueda de la URL solicitada entre las almacenadas
            recorremos todos los objetos guardados en el atributo uris
            */
            if ($recordUri->match($uri)) {//llamamos el metodo match de ./src/router/Uri.php para verificar que s cohincide la URI con la URL solicitada 
                return $recordUri->call();
            }
        }

        //Muestra el mensaje de error 404...
        header("Content-Type: text/html");
        echo 'La uri (<a href="' . $uri . '">' . $uri . '</a>) no se encuentra regiostrada en el método ' . $method . '.';
    }


   

}
