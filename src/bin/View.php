<?php
/*esta clase contiene metodos GENERALES que son utilizados en las vistas del proyecto*/

class View {

    protected $variables;
    protected $ouput;

    function __construct() {
        
    }

    public function render($file, $variables = null) {//PASO 73 metodo para renderizar un archivos del proyecto

        /*para el renderizado efectivo de nuestro proeyecto usaremos un bufer
        
        Un buffer es un espacio en memoria en el que se almacenan datos de manera temporal, 
        normalmente para un uso concreto como evitar que un programa se quede sin datos en una transferencia irregular o lenta.
        */

        $this->variables = $variables;

        $file = PATH_VIEWS . $file;

        ob_start(); //iniciamos el bufer
        //para mas detalles leer el manual de php: https://www.php.net/manual/es/function.ob-start.php

        $this->includeFile($file); //PASO 74 metodo de inclucion de archivos

        $output = ob_get_contents(); //almacenamos el contenido rederisado y almacenado del búfer, que se a elavorado con el archivo importado

        //para mas detalles leer el manual de php:https://www.php.net/manual/es/function.ob-get-contents.php

        ob_end_clean();//cerramos el bufer

        return $output;
    }

    public function includeFile($file) {//PASO 74 metodo para llamar archivos de nuetro proyecto en las vistas a renderizar
        //Creamos las variables en el contexto actual del archivo que se esta buscando renderizar


        if (isset($this->variables) && is_array($this->variables)) {//validamos si tenemos variables que seran recibidas en el archivo
            //deben tanto de existir como ser un arreglo
            foreach ($this->variables as $key => $value) {//recorremos las variables
                global ${$key}; 
                /*y de manera global dentro de la instancia de la vista definimos un arreglo que nos permite hacer la
                 declaracion de cada variable recibida y el valor correspondiente*/
                ${$key} = $value;//asigno cada posicin del arreglo global con el nombre de la variable como indice y el valor correspondiente
            }
        }


        /*VALIDAMOS si el archivo solicitado existe en cada uno de sus formatos posibles DENTRO del proyecto*/
        if (file_exists($file)) {
            return include $file;
        } else
        if (file_exists($file . ".php")) {
            return include $file . ".php";
        } else
        if (file_exists($file . ".html")) {
            return include $file . ".html";
        } else
        if (file_exists($file . ".htm")) {//esta es una ejemplificacion donde podemos observar que podemos ubicar cualquier posible extencion de archivos
            return include $file . ".html";
        } else {
            echo "<h2>No existe el archivo: $file</h2><br/>";
        }
    }

}
