<?php
/*Dentro de este archivo Roots o Raiz definimos las rutas de las CARPETAS contenedoras
 estas son definidas como Constantes para ubicar nuestras carpetas y los archivos que contienen estas
 
 Se define como Constantes porque asumimos que estan no van a variar dentro de la carpeta de nuestro sistema

Por convencion usamos la palabra PATH_NombrCarpeta para nombrar la ruta de la carta [Path-camino/ruta]
 */

 define('PATH_APP', './app/');
 define('PATH_CONFIG', './config/');
 define('PATH_SRC', './src/');
 define('PATH_ROUTES', './routes/'); //carpeta contenedora de las rutas VALIDAS de acceso al sistema (PASO 50)
 define('PATH_CONTROLLERS', './app/http/controllers/'); //Ruta de los controladores del proyecto
 define('PATH_VIEWS', './resources/views/'); //Ruta de las vistas del proyecto 
