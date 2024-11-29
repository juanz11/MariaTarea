<?php
/* PASO 71 defino una clase Controller que almacenara metodos GENERICOS de los controladores del
proyecto el cual debe de heredarse en TODOS los controladores del proyecto para poder invocar adecuadamento sus metodos*/

class Controller {
    // defino los attributos $request que almacena las solicitudes a los controladores y $view que gestiona el llamado de las vistas del proyecto
    protected $request;
    private $view;

    function __construct() {
        
    }

    function view($file, $variables = null) {//PASO 72 defino un metodo que manejara llamada a las vistas de los controladores
        //recibe una ruta de una archivos y un arreglo de variables
        if (empty($this->view)) {//valido si el atributo view esta vacio
            $this->view = new View();//instancio una nueva clase en ./src/bin/View.php PASO  73
        }
        return $this->view->render($file, $variables);//llamos al metodo render del archivo View.php 
    }

    function getRequest() {
        return $this->request;
    }

    function setRequest($request) {
        $this->request = $request;
    }

}
