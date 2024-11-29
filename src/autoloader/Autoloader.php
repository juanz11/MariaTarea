<?php
/*PASO 44 dado a que se buscara organizar las rutas se define una estructura clara de carpetas en base a la funcionabilidades
de los archivos que contienen las misma

-CRUD1   
    -app
        -conexion
        -contantes
        -http
        -persistencia
    -config
        autoloader.php
    -src
        -autoloader
            Autoloader.php
        Roots.php
    index.php


    Donde las carpetas:
        -app: contendra todos los archivos que componen nuestro sistema, en otras palabras es donde se gestionara
            el ordenamiento de las clases que dan forma y funcionabilidad directa al sistemas. Dentro de esta carpeta 
            encontramos:

                -conexion: contiene todos los archivos relacionados a la conexion con las BD necesarias para la
                    operatividad del sistema.

                -constantes: donde alamacenamos todos los archivos que alamaenar valores contantes a utilizar.

                -http: es donde almacenamos todas las funcionabilidades operativas del sistema (Controladores), que operan
                en base a la interaccion del usuario (Vistas) y los datos del sistmas (modelos).

                -persistencia: aquellos archivos que manenajan los datos del sistamas (Modelos-CRUD); y estan en constante 
                espera de la interaccion con el sotfware.
        
        -config (configuration - configuration: Almacena aquellos archivos de configiracion del sistma autoloader.php retorna 
        la ruta de donde estan las funcionabilidades y como son manejadas las rutas de los archivos del sistema


        -src (source - fuente, origen, procedencia): establecemos el origen de las funcionabilidades del sistema, es donde, se
        encuentran los archivos que "guian" la opratividad del sistema

*/

class Autoloader { //PASO 45 definimos la clase Autoloader

    /*El autoload es un mecanismo que permite cargar automáticamente las clases cuando se utilizan por primera vez 
    en un script PHP. En lugar de tener que incluir manualmente cada archivo de clase, el autoload carga automáticamente 
    las clases necesarias cuando se utilizan por primera vez.

    Para utilizar el autoload en PHP, es necesario registrar una función de autoload que se encargará de cargar las clases 
    cuando se necesiten. La función de autoload recibe el nombre de la clase como argumento y busca el archivo de la clase 
    en el sistema de archivos. Si encuentra el archivo, lo carga automáticamente. Si no lo encuentra, se produce un error.

    El autoload es especialmente útil en proyectos grandes donde hay muchas clases. Al utilizar el autoload, es más fácil 
    mantener el código organizado y estructurado. También ayuda a evitar errores al cargar manualmente cada archivo de clase.*/

    public static function registrar() { //para establecer el autoload

        if (function_exists('__autoload')) {//verificamos si se a registrado un autoload antes

            spl_autoload_register('__autoload'); //Si ya esta registrado confirmamos el autoload
            return;
        }


        //aqui verificamos la version de php con que cuenta el sistema en caso de NO haber un autoload registado 

        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {// si es mayor o igual que la 5.3.0 utilizamos el siguiente formato del metodo reservado 
            
            spl_autoload_register(array('Autoloader', 'cargar'), true, true);//'cargar es el nombre de un metodo que establecemos mas adelante'
            //el primer pararamento true nos permite relanzar la exepciones que pueda generar el autoload
            //el segundo parametro true nos premite anteponer el autoload en sus llamadas sobre las rutas que contiene

        } else {// si es menor que la version señalada se usa la siguiente formate de la funcion

            spl_autoload_register(array('Autoloader', 'cargar'));

            /* para mayor informacion de la funcion spl_autoload_register()
                https://codersfree.com/courses-status/aprende-php-y-mysql-desde-cero/autoload-en-php
                https://www.php.net/manual/es/function.spl-autoload-register.php
            */
        }
    }

    public static function cargar($clase) {//PASO 46 en metodo cargar recibe la clase que se busca utilizar

        $nombreArchivo = $clase . '.php'; 
        /*para UBICAR el archivo donde se codifico(escribio) la clase, concatenamos la extenxion .php que debe de poseer 
        el archivo, si nos fijamos TODAS los archivos deben de POSEER el mismo Nombre de las Clases que contienen. 
        Por eso meintras reorganizaba el proyecto a la estructura que puede detallar al inicio de este documento renombre
        los archivos adecuadamente para sergui ademas de los estandares; permitir que esta logica se cumpla.

        En caso de NO cumplir con este estandar, el autoload NO podra ubicar la ruta del Archivo que contiene la clase y 
        se generara ERRORES
        */

        //PASO 47 generamos 2 nuevos archivos en la ruta y nombre: ./src/Roots.php   y ./config/autoloader.php 
        //lo que hace cada archivo se especifica dentro de este, y su funcion es evitar extender esta clase
        //y permitir la modificacion de las rutas de los archivos de una mejor manera



        $carpetas = require PATH_CONFIG . 'autoloader.php';  // requerimos mediante una constante la ruta de principal de las 
        //carpetas que formar las operaciones del sistema y aquella que maneja el como se direcciona el sistema


        foreach ($carpetas as $carpeta) {//por cada ruta de carpeta obtenidad

            //enviamos la informacion del archivo que Se DESEA ubicar en base a la CLASE que DEDE de contener
            if (self::buscarArchivo($carpeta, $nombreArchivo)) {
                //como nuestro metodo es privado y esta dentro de la clase usamos  self:: para que busque el metodo 
                //dentro de la misma clase como si redicdecionaramos


                return true;//si encontramos el archivo retornamos true
            }
        }
        return false;// de lo contrario false
    }

    private static function buscarArchivo($carpeta, $nombreArchivo) { //PASO 47 Definimos el metodo buscarArchivo()

        $archivos = scandir($carpeta); /*Enumera los ficheros y directorios ubicados en la ruta especificada, Metodo
        reservado de PHP que Devuelve un array con los ficheros y los directorios que se encuentran */

        foreach ($archivos as $archivo) {//recorremos el arreglo de los directorios o carpetas

            $rutaArchivo = realpath($carpeta . DIRECTORY_SEPARATOR . $archivo); // https://www.php.net/manual/es/function.realpath.php
            /*utilizamos esta funcion apra que nos devuelva la ruta real de cada directorio/carpeta  y de cara archivo 
            dentro de la ruta de la carpetar primara que recibirmos desde el metodo cargar()*/

            if (is_file($rutaArchivo)) {//verificamos si la ruta es realmente un archivo y no una carpeta

                if ($nombreArchivo == $archivo) {
            //verificamos si la que dicho archivo tenga el mismo nombre del archivo que queremos ubicar en nuestro proyecto

                    require_once $rutaArchivo; //incluimos la ruta en la llamada del autoload de la clase que buscamos

                    return true;//retornamos true para romper el ciclo del foreach e indicar que se consiguio la ruta
                }

            } else if ($archivo != '.' && $archivo != '..') {//cuando sera una carpeta

               self::buscarArchivo($rutaArchivo, $nombreArchivo);
               //enviamos la ruta obtenida que seria la ruta de la nueva carpata

                /*hacemos una llamada recursiva dle mismo metodo buscar archivo para volver a inicialicar la busqueda
                mas ahora dentro de la carpeta encontrada
                */

            }
        }
        return false;// esto en caso de no encontrar el archivo con la Clase que se busca

        //ir al index para ver en el PASO 48 como se prueva el autoload
    }

}
