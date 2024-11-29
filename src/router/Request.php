<?php

class Request {
    /*creamos una clase para trabajar con el objeto $_REQUEST de php y su contenido*/
    protected $request;
    protected $data;
    public $method;

    public function __construct($request, $flag = true) {
        //$request contien la info de $_REQUEST de php el cual es un arreglo
        $this->request = $request;
        $this->extractData();
        $this->setExtraData($flag);
    }

    public function extractData() {
        $this->data = array();//asignamos al atributo de los datos recibidos un array vacio que llenraremos

        foreach ($this->request as $key => $value) {//recorriendo cada uno de los enementos con sus valores del arreglo que poseia $_REQUEST

            if (is_object($value) || is_array($value)) {//si el valor o valores del elemento es un objeto o un arreglo

                $this->data[$key] = new Request($value, false);//creamos una nueva instancia donde asignamos a un nuevo attributo de los DATOS dichos valores

            } else {//si ni es un objeto o un arreglo
                if ($key != "http_referer") {//Información del entorno del servidor y de ejecución
                    //es un campo que registra la última URL que la usuaria/o visitó antes de acceder a otra web. Registra las URLs de referencia en $_REQUEST


                    $this->data[$key] = $value; //asignamos dicho valor que esta dentro de las peticiones

                }
            }
        }
    }

    public function setExtraData($flag) {
        if ($flag == true) { // validamos si existe flag

            $this->method = $_SERVER["REQUEST_METHOD"];//asignamos el metodo recibido de tranferencia

            $this->data["http_referer"] = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : null;
            //asiganmos en caso de existir los valores de http_referer 

            $headers = apache_request_headers();//Obtiene todas las cabeceras de petición HTTP de la llamada actual
            $this->data["headers"] = new Request($headers, false);// intanciamos la informacion que recibimos con un arreglo para usarlo como objeto
        }
    }

    public function __get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;//retornamos los valores en caso de existir que se resivan por la peticion y esten guardados en nuestro objeto
    }

    public function __set($key, $value) {//establecemos valores 
        $this->data[$key] = $value;
    }

    public function all() { //retornamos toda la informacion que recopoleamos mediante la URI
        return $this->data;
    }

}
