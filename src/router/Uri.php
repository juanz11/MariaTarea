<?php
// definimos todos los metodos que invlocuran las URIs
class Uri {
    //establecemos los atributor de la clase
    var $uri;
    var $method;
    var $function;
    var $matches;
    protected $request;
    protected $response;

    public function __construct($uri, $method, $function) {//PASO 52 construimos el objeto con los valores recibidos 
        $this->uri = $uri;
        $this->method = $method;
        $this->function = $function;
    }
    
    //PASO 56 definimos las funciones que operanar los datos recibidos por la URL

    public function match($url) { 
        /*Realiza una búsqueda para comparar si es la misma que hemos registrado nuestro objeto */

       $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->uri);//separamos el path o ruta de los parametros señalados

       $regex = "#^$path$#i";//definimos una exprecion regular con un formato definido 

       // pasamos el patron con el formato indicado en $regex (regular exprecion) y compramos si esta en el objeto
       if (!preg_match($regex, $url, $matches)) {

           return false;//en caso de no existir dicha url indicamos que no es valida

       }

        //verificamos que estamos recibiendo los datos por un metodo valido

       if ($this->method != $_SERVER['REQUEST_METHOD'] && $this->method != "ANY") {
           return false;
       }
       array_shift($matches);//Quita un elemento del principio del array en este caso el incio de la url, para enclarecernos cualquier parametro de recibamos
       $this->matches = $matches;
       return true;
   }



   private function execFunction() {//PASO 57
    $this->parseRequest(); //limpiamos o convertimos la peticiones

    $this->response = call_user_func_array($this->function, $this->matches); 
    //ejecuta la funcion o metodo que mademos mediante la URI de nuesto sistema y es solicitada mediante le URL

    }


    private function formatCamelCase($string) {
        //PASO 69 formatear el metodo recibido por la URL a CamelCase para evitar errores
        /*si NO se declararon los metodo en formato CamelCase es decir la primera letra de la primera palabra
        en minuscula y luego las primera letra de las demas palabras en Mayusculas (ejemploDeclaracion, 
        otroEjemploDeclaracion, yOtroEjemploMas), se presentara errores al momento de ubicar el metodo de interes 
        dentro de la clase*/

        /*usamos preg_split() para dividir la cadena recibida por la URL usando los guiones - _ como punto de separacion
        y strtolower para devolver todos caracteres alfabéticos convertidos a minúsculas. */

    $parts = preg_split("[-|_]", strtolower($string)); 
        //pasamos: listar_usuarios. = ["listas", "usuarios"] ó Lista-Usuarios = ["listas", "usuarios"]

    $finalString = "";// declaro una variable para almacenar la cadena final una vez modificada

    $i = 0;//difinimos un "policia" para que el primer elemento o palabra de la cadena este en minuscula
    

    foreach ($parts as $parts) {

        /*valaidamos si al recorer el arreglo es el primer elemnto o palabra
        en cuyo caso nos aseguramos que todas las letras esten en minusculas y cuando sea cualqueir otro elemento
        usamos ucfirst() para colocar en mayuscula la primer letra de dicha palabra o elemento */
        $finalString .= ($i = 0) ? strtolower($parts) : ucfirst($parts);


        $i++;//incrementamos el valor del "policia" para una vez tratada la primera palabra se verifique adecuadamente el resto
    }

    return $finalString; //retornamos la cadena final

    }

    private function getParts() {

        //PASO 68 PARTES DE LA CADENA RECIBIDA         
        /*ESTO SE HACE PARA: dividir y detectar la clase del controlador que se quiere ejecutar y el metodo de interes*/

        $parts = array();//instancio un arreglo VACIO

        /*detectamos si la funcion de llamada contiene el indicador @ para llamar al metodo 
        LEER explicacion en ./routes/web.php "parametrización de las ruta de clases"*/
        if (strpos($this->function, "@")) {

            //dividimos la cadena recibida por URL en dos partes usando de referencia el @
            $methodParts = explode("@", $this->function); 


            $parts["class"] = $methodParts[0];//la primera parte o lo que esta ANTES del @ es la clase
            $parts["method"] = $methodParts[1];//la segunda parte o lo que esta DESPUES del @ es el metodo

        } else {//si la cadena recibida NO contiene el @

            $parts["class"] = $this->function;//indicamos que la clase es la cadena recibida

            /*validamos si la cadena recibida es / entonces el metodo es el index DEL CONTROLADOR sino entonces 
            formateamos el metodo a CamelCase PASO 69 
            
            ACLARACION se hace llamado del metodo index CONTENIDO de un controllado y NO a index.php; ya que recordemos 
            que un controlador CONECTA los modelos y las VISTAS y una vista PUEDE tener su index que seria lo que inicalmente
            muestra por pantalla, algo asi como la VISTA INICAL dentro de dicha URL
            */
            $parts["method"] = ($this->uri == "/") ? "index" : $this->formatCamelCase($this->uri);
        }
        return $parts; //retornamos las partes de la cadena con el formato adecuado CamelCase

    }

    private function functionFromController() {

        //PASO 67 

        $parts = $this->getParts(); //llamamos un metodo para definir las partes de la cadena en el paso 68

        //obtenemos las parte de la cadena ya trabajadas
        $class = $parts["class"];
        $method = $parts["method"];

        //Importamos el controlador... PASO 70
        if (!$this->importController($class)) {
            return;
        }

        //Preparar la ejeución parseando la solicitud creado un objeto de request de php...
        $this->parseRequest();

        $classInstance = new $class();//instanciamos la clase requerida por la URL

        /*definimos un nuevo metodo dentro del PASO 71 ./app/http/controller.php para almacenar las peticiones de la URL*/
        $classInstance->setRequest($this->request);


        //Lanzamos el método...
        $launch = array($classInstance, $method);
        if (is_callable($launch)) {
            $this->response = call_user_func_array($launch, $this->matches);
        } else {
            throw new Exception("El método $class.$method no existe.", -1);
        
        }
    }

    public function call() {//PASO 59
        try {
            $this->request = $_REQUEST;//igualamos nuestro atributo request (peticion) a lo contenido en la variable php $_REQUEST
            //Un array asociativo que por defecto contiene el contenido de $_GET, $_POST y $_COOKIE.

            //PASO 66 validamos si la funcion recibida es una cadena
            if (is_string($this->function)) { 
                $this->functionFromController(); //llamamos un nuevo definido arriba
            } else {
                $this->execFunction();
            }
            $this->printResponse();
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
        
    }

    private function parseRequest() { //PASO 58
        $this->request = new Request($this->request);//asignamos el request o peticiones que recibimos de la URL al objeto URI
        $this->matches[] = $this->request; //asignamo al objeto las solicitudes recibidas

    }

    private function printResponse() { //PASO 60
        if (is_string($this->response)) {//si es un string
            echo $this->response; 
        } else if (is_object($this->response) || is_array($this->response)) {//si es una objeto o array
            $res = new Respuesta();//parseamos el valor de $_REQUEST
            echo $res->json($this->response);//haciendo que el array u objeto tome la forma la estrutura JSON
        }

    }

    public function importController($class) {//PASO 70 definimos un metodo que busca el controlador dentro de la clase

        $file = PATH_CONTROLLERS . $class . ".php";//definimos la ruta donde DEBE de estar el controlador si a sido declarado

        if (!file_exists($file)) { //en caso de de NO existir el controlador
            throw new Exception("El controlador ($file) no existe."); //arrojamos un ERROR donde indicamos que la ruta señalada no existe
            return false;//retronamos false para terminar el metodo e indicar que NO fue encontrado
        }
        require_once $file; //requerimos o importamos el archivo que contiene el controlador
        return true;

    }

}
