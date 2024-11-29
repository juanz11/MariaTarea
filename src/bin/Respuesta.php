<?php
/*PASO 38 una vez hechas las pruebas  del controlador buscamos estandarizar las repsuestas o mensajes de los metodos
para esto definimos un metodo respuesta que maneje todos los mensaje dados por las consultas a la BD
*/
class Respuesta {
    //estos atributos estan basados en los atributod de los objetos que inicalmente regresabamos mediante el controlador
    public $codigo;
    public $mensaje;
    public $datos;

    function __construct($codigo = null, $mensaje = null, $datos = null) {
        /*PASO 39 establecemos un metodo __construct() que nos contruya el mensaje y no regrese la informacion de interes para la
        operatividad general del sistema (como si se logro o no la opreacion)*/

        //Obtener la respuesta por defecto mediante el código.
        if (isset($codigo) && empty($mensaje)) { 

            $respuesta = EMensajes::getMensaje($codigo); //llamamos el metodo que nos puede dar el mensaje adecuado en base
            //a la verificacion o comprobacion que se hace en el controlador

            $this->codigo = $respuesta->codigo; //establecemos el CODIGO de la respuesta en base al resultado obtenido en $respuerta

            $this->mensaje = $respuesta->mensaje; //establecemos el _MENSAJE de la respuesta en base a valores de  $respuerta

            $this->datos = $respuesta->datos; //establecemos los datos de la respuesta en base a lo contenido en $respuerta

            return;
        }

        if (is_string($codigo)) {//comprobramos si el codigo es un string

            $temp = EMensajes::getMensaje($codigo);//obtenemos el condigo mediante la clase EMensaje() para que sea del tipo adecuado

            $codigo = $temp->codigo; //seteamos el condigo resivido para que sea un entero
        }

        // se igualan los atributos de la clase a los recibidos en el constructor
        $this->codigo = $codigo; 
        $this->mensaje = $mensaje;
        $this->datos = $datos;
    }

    public function json($obj = null) { //PASO 40 establecemos de una vez un metodo que nos defina el envio de informacion mediante JSON
        
        //creamos un metodo que nos permita codificar bien sea por un objeto o un array que no devuelve un string JSON 
        //para ser utilizado

        header('Content-Type: application/json'); /*la cabecera content type indica el tipo de archivo o medio utilizado
         en la comunicación entre el cliente HTTP y el servidor para ayudarlos a comprender el formato en que la
         información está siendo enviada*/

        if (is_array($obj) || is_object($obj)) {

            return json_encode($obj); //Retorna la representación JSON del valor dado o en esta caso del objeto

        }
        return json_encode($this);//retorno lo atributos como JSON
    }

    //se generan los metodos get y set de la Clase Respuesta

    function getCodigo() {
        return $this->codigo;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getDatos() {
        return $this->datos;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setDatos($datos) {
        $this->datos = $datos;
    }

}
