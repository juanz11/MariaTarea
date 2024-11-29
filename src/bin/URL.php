<?php

class URL {//PASO 80 clase para gestionar las rutas de nuestro proyecto obteniendo las URL ingresadas para poder usar nuestras rutas personalizadas

    public static function base() {// devuelve la url base o domino principal del proyecto
         
         /* si se ingresa https://www.ejemplo.com/CRUD?parametro=ejemplo1  nos devuelve  https://www.ejemplo.com*/

        $base_dir = str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
        //obtenemos la ruta de la carpeta que esta visitanto el usuario desde el navegador

        //concatenamos esa direccion a la direccion del host donde es alojada nuestra paginas web
        /*verificamos cual protocolo de transferencia de hipertexto (http) usamos si el estandar o encritado (https) y 
        concatenamos a la ruta de nuestro host y el directorio de nuestro proyecto*/
        $baseURL = (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$base_dir}";

        return trim($baseURL, "/");
    }

    public static function to($url) {//metodo para concatenar rutas en nuestro proyecto

        $url = trim($url, "/");// limpiamos la url que queremos concatenar del ultimo caracter "/" en caso de poseerlo

        //retornamos la URL base del proyecti + la URL que queremos concatenar
        return URL::base() . "/{$url}?v=".time();
        /*añado a la URL la hora contenandola como valor esto es un recurso de DESARROLLO al momento de trabajar con archivos JS
        que permite que los navegadores actualizen las modifciaciones que se hacen durante el DESARROLLO, ya que, existe la
        problematica que los navegadores almacenan los recursos en la cache por lo tanto NO toman en cuenta las modificaciones
        que se estan realizando a los archivos YA cargados. Este tip es valido unicamente para el DESARROLLO, una vez se va a
        IMPLEMENTAR el proyecto hay que remover este añadido a la URL para evitar conflictos con los host.

        repito valiso SOLO para la etapa de DESARROLLO, NO DEDE UTILIZARSE en la fase de IMPLEMENTACION o PRODUCCION. 
        Ya que esto implica una deuda tecnica de recursos del usuario, ergo un FALLO DE IMPLEMENTACION

        para la fase de IMPLEMENTACION o produccion, se HA de SUSTITUIR la funcion de php time() por la VERSION del 
        proyecto que se esta poniendo en linea
        */
    }

    public static function getFull() {
        /*este metodo es para obtener TODA la URL ingresada por el usuario
        si se ingresa https://www.ejemplo.com/CRUD?parametro=ejemplo1 otenemos TODA la ruta
        */
        
        return (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
    }

}
