<?php

/*PASO 49 desarrollamor una launcher que sera donde despliegaremos la aplicacion*/

require './src/Roots.php';
require PATH_SRC . 'autoloader/Autoloader.php';

Autoloader::registrar();//cargamos las rutas y registramos el autoload 

//PASO 50 definimos en nuestro archivo Roots.php una contante que contendra la direccion de las URL del sistema
$rutas = scandir(PATH_ROUTES);   //listamos los archivos de la rutas del sistema

foreach ($rutas as $archivo) { //PASO 51 mediante este foreach importamos los archivos con las rutas de nuestro sistema

    $rutaArchivo = realpath(PATH_ROUTES . $archivo); //definimos la ruta

    if (is_file($rutaArchivo)) { //si es un archivo valido (.php o otra extension) 

        require $rutaArchivo; //importamos la ruta del archivo
    }
}
/*ya tenemos una llamada a la ruta de los ARCHIVOS el sistema; ahora falta correlacionar dichos archivos a una ruta URL
que podamos recibir, asi como especificar el metodo de envio y reccepcion de datos*/

/*para ello definimos una carpeta hara las operaciones de la rutas (router) y dentro de ella un archivo ./src/router/Route.php
que definira  

 seguo en el PASO 51 en la ruta ./src/router/Route.php

*/

Route::submit();
