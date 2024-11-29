
> ## CURD 1 - Crud MVC con PHP Ajax y MySQL COMPLETADO
> En este proyecto encontraremos un CRUD con Ajax, PHP y MySQL, en este se podrá observar un ejemplo básico de como listar, insertar, actualizar y eliminar registros con ajax, php y mysql. > Además podermos observar como se realiza una conexión PDO, un controlador de persistencia para la base de datos genérico y un ejemplo básico para observar como funciona un controlador de rutas o Routing en PHP.
> 
>


> ## PHP Version (8)
> Actualmente estoy trabajando en la versión 8 de PHP, he probado exactamente la versión `8.0.28` en MacOS y en Windows la versión `8.0.30`. Deberías poder usar una versión 8 reciente, yo he usado estas especifícamente ya que son las versiones que actualmente soportan los servicios de hosting en el mercado.

> ## Recursos de Terceros utilizados

>jQuery v3.4.1; es una biblioteca de JavaScript diseñada para simplificar el recorrido y la manipulación del  DOM HTML, así como el manejo de eventos, animaciones CSS y Ajax. [query.org/](https://jquery.com)

>SweetAlert: es una librería de JavaScript que permite mostrar notificaciones al cliente. Es un reemplazo para los cuadros emergentes de JavaScript que se puede personalizar y es accesible. https://sweetalert2.github.io

>Bootstrap v4.3.1; es un framework CSS utilizado en aplicaciones front-end — es decir, en la pantalla de interfaz con el usuario— para desarrollar aplicaciones que se adaptan a cualquier dispositivo. https://getbootstrap.com/

>helperform: herramienta para la agilizacion del manejo de formularios, Creado por Starlly Software : http://starlly.com

>app.global.js: libreria para el parseo de datos, e implentacion AJAX mediante los comando de jQuery, Creado por Starlly Software : http://starlly.com


>## Rutas donde se ubica el PASO a PASO de la elaboracion del proyecto


-PASO 1:  ./app/conexion/Conexion.php  

-PASO 2:  ./app/conexion/Conexion.php  

-PASO 3:  ./app/conexion/Conexion.php  

-PASO 4:  ./app/conexion/Conexion.php    

-PASO 5:  ./app/conexion/Conexion.php  

-PASO 6:  ./app/conexion/Conexion.php   

-PASO 7:  index.php   

-PASO 8:  ./app/conexion/Conexion.php  

-PASO 9:  ./app/persistencia/Crud.php  

-PASO 10:  ./app/persistencia/Crud.php  

-PASO 11:  ./app/persistencia/Crud.php  

-PASO 12:    index.php   

-PASO 13:  ./app/persistencia/Crud.php  

-PASO 14:  ./app/persistencia/Crud.php  

-PASO 15:  ./app/persistencia/Crud.php  

-PASO 16:  index.php  

-PASO 17:  ./app/persistencia/Crud.php  

-PASO 18:  tuve hambre me sale el numero    

-PASO 19:  ./app/persistencia/Crud.php  

-PASO 20:  ./app/persistencia/Crud.php  

-PASO 21:  ./app/persistencia/Crud.php  

-PASO 22:  index.php  

-PASO 23:  index.php  

-PASO 24:  ./app/persistencia/Crud.php  

-PASO 25:  ./app/persistencia/modelos/ModeloGenerico.php  

-PASO 26:  ./app/persistencia/modelos/ModeloGenerico.php  

-PASO 27:  ./app/persistencia/modelos/ModeloGenerico.php  

-PASO 28:  ./app/persistencia/modelos/ModeloGenerico.php  

-PASO 29:  ./app/persistencia/modelos/ModeloGenerico.php  

-PASO 30:  ./app/persistencia/modelos/ModeloGenerico.php  

-PASO 31:  ./app/persistencia/modelos/Usuarios.php    

-PASO 32:  ./app/persistencia/modelos/Usuarios.php   

-PASO 33:  ./app/persistencia/modelos/Usuarios.php   

-PASO 34:  index.php  

-PASO 35:  ./app/controlador_inicial/ControladorUsuarios0.php  

-PASO 36:  ./app/controlador_inicial/ControladorUsuarios0.php  

-PASO 37:  index.php  

-PASO 38:  ./app/http/Respuesta.php  

-PASO 39:  ./app/http/Respuesta.php  

-PASO 40:  ./app/http/Respuesta.php  

-PASO 41:  ./app/constantes/EMensaje.php  

-PASO 42:  ./app/http/ControladorUsuarios.php  

-PASO 43:  index.php  

-PASO 44:  ./src/autoloader.php  

-PASO 45:  ./src/autoloader.php  

-PASO 46:  ./src/autoloader.php  

-PASO 47:  ./src/autoloader.php  

-PASO 48:  index.php  

-PASO 49:  ./src/launcher.php  

-PASO 50:  ./src/launcher.php  

-PASO 51:  ./src/router/Route.php  

-PASO 52:  ./src/router/Uri.php  

-PASO 53:  ./src/router/Route.php  

-PASO 54:  ./src/router/Route.php  

-PASO 55:  ./src/router/Route.php  

-PASO 56:  ./src/router/Uri.php  

-PASO 57:  ./src/router/Uri.php  

-PASO 58:  ./src/router/Uri.php  

-PASO 59:  ./src/router/Uri.php  

-PASO 60:  ./src/router/Uri.php  

-PASO 61:  ./routes/web.php  

-PASO 62:  SE define una nueva constante de RUTA en ./src/Roots.php para los controladores para hacer un uso adecuado de esta se define una capeta especifica en la ruta app\http\controllers y paso los controladores externos de la carpeta http dentro de dicha carpeta. Esto se hace ademas de para organizar es para no confundir recursos  

-PASO 63:  Asi mismo definimos una nueva constantes de RUTA en ./src/Roots.php para las vistas; Una vista es uno de los muchos recursos que puede tener un proyecto para poder interectuar con el ususario, asi mismo una vista forma parte de la estrutura de un portal web. Por ende se crea una carpeta resources(recursos) y dentro de dicha carpeta views (vistas), y por dende la ruta que se define en la variables sera ./resources/views/

-PASO 64: Se sigue con la modificacion de la estructura del proyecto para llevarse a una estructura mas estandar, creando una carpeta "bin" en la ruta .src\bin esta carpeta En programación,  contiene los archivos binarios que se generan al compilar un proyecto. La palabra bin es la abreviatura de binary, que significa binario. Y normalmente se utiliza para almacenar los archivos de VALIDACIONES de nuestro proyecto siempre que los resultados arrojados de dicha validaciones sean o manejen una estructura booleana; en el protecto propuesto, el archivo Respuesta.php cumple con estos requisitos ya que sus operaciones son el resultado de las "validaciones" que hace el Controllador. Por lo tanto lo movemos a esta nueva carpata

-PASO 65: Creamos dentro de la carpeta bin un archivo View.php 

-PASO 66: ./src/router/Uri.php

-PASO 67: ./src/router/Uri.php

-PASO 68: ./src/router/Uri.php

-PASO 69: ./src/router/Uri.php

-PASO 70: ./src/router/Uri.php

-PASO 71: ./app/http/controller.php

-PASO 72: ./app/http/controller.php

-PASO 73: ./src/bin/View.php

-PASO 74: ./src/bin/View.php

-PASO 75: ./routes/web.php  

-PASO 76: ./app/http/ControladorUsuarios.php  

-PASO 77: ./resources/view/welcome.php

-PASO 78: ./routes/web.php  

-PASO 79: ./resources/view/welcome.php

-PASO 80: ./src/bin/URL.php

-PASO 81: ./resources/view/welcome.php

-PASO 82: importacion de herrmientas de terceros ./assets  En programación, un asset es un recurso digital que se puede utilizar en un proyecto. Puede ser una libreria, archivo de audio, una imagen, un modelo, un archivo de video, un archivo CSS, un archivo JavaScript, o cualquier otro tipo de archivo que se soporte dentro del proyecto. Los assets normalmente se organizan en carpetas de assets para tener un mejor control del contenido. 

-PASO 83: Dentro de la carpeta assets se genera una carpeta llamada js que contendra todos los archivos JavaScript del proyecto y otro llamada plugins; los plugins son complementos que añaden funcionalidades extra o mejoras a los programas. Es decir, son miniprogramas que suman alguna característica que no venía por defecto en el programa origina

-PASO 84: dentro de la carpeta assets es donde se añadio la carpeta por defecto que se descarga en la pagina oficial de bootstrap

-PASO 85: en la carpeta plugins se añadio la libreria Jquery 

-PASO 86: importamos los recursos incluidos en ./resources/view/welcome.php

-PASO 87: en la carpeta js generamos dos nuevas carpetas global y modulos, dentro de la carpeta global incluyo una libreria llamada "helpperfom.js" sirve para agilizar la captura de informacion que es llenada en los formularios

-PASO 88: importamos las librerias en ./resources/view/welcome.php

-PASO 89: Se Genera en ./app/assets/js/modulos/lista.usuario.js "lista.usuario.js" un archivo que contiene el OBJETO vista que se utilizara para manipular el DOM de la vista donde se listara los usuarios

-PASO 90: ./app/assets/js/modulos/lista.usuario.js

-PASO 91: ./app/assets/js/modulos/lista.usuario.js

-PASO 92: ./app/assets/js/modulos/rutas.api.js

-PASO 93: ./app/assets/js/modulos/lista.usuario.js

-PASO 94: ./app/assets/js/modulos/lista.usuario.js

-PASO 95: ./app/assets/js/modulos/lista.usuario.js

-PASO 96: ./app/assets/js/modulos/lista.usuario.js

-PASO 97: inserto en ./app/assets/pluging la carpeta de la libreria sweetalert

-PASO 98: cree el archivo ./app/assets/js/modulos/registrar.usuarios.js para la manipulacion de la vista del registro de usuario y cree la carpeta ./resources/views/usuarios y dentro del archivo registrarusuario.php que sera el archivo que contendra la vista del formulario de registro

-PASO 99: maqueto el formulario html en ./resources/views/usuarios/registrarusuario.php

-PASO 100: ./routes/web.php  

-PASO 101: ./app/http/ControladorUsuarios.php

-PASO 102: ./routes/web.php  añadimos las rutas de los recursos que se utilizaran

-PASO 103: ./app/http/ControladorUsuarios.php modificacion del metodo insertarUsuarios

-PASO 104: /app/assets/js/modulos/registrar.usuarios.js

-PASO 105: /app/assets/js/modulos/registrar.usuarios.js

-PASO 106: /app/assets/js/modulos/registrar.usuarios.js

-PASO 107: /app/assets/js/modulos/registrar.usuarios.js

-PASO 108: /app/assets/js/modulos/registrar.usuarios.js

-PASO 109: ./routes/web.php 

-PASO 110: ./app/http/ControladorUsuarios.php

-PASO 111: ./resources/views/usuarios/registrarusuario.php

-PASO 112:  ./resources/views/usuarios/registrarusuario.php

-PASO 113:  ./resources/views/usuarios/registrarusuario.php

-PASO 114: ./app/http/ControladorUsuarios.php

-PASO 115: ./routes/web.php 

-PASO 116: ./app/assets/js/modulos/registrar.usuarios.js

-PASO 117: ./app/assets/js/modulos/registrar.usuarios.js

-PASO 118: ./app/assets/js/modulos/registrar.usuarios.js

-PASO 119: ./app/assets/js/modulos/rutas.api.js

-PASO 120: ./app/assets/js/modulos/registrar.usuarios.js

-PASO 121: ./routes/web.php

-PASO 122: ./app/assets/js/modulos/rutas.api.js

-PASO 123: Desde la lista que se muestra en la tabla activamos el boton para eliminar usuarios ./app/assets/js/modulos/lista.usuario.js

-PASO 124: ./app/assets/js/modulos/lista.usuario.js

-PASO 125: ./app/assets/js/modulos/lista.usuario.js

-PASO 126: ./app/assets/js/modulos/lista.usuario.js

-PASO 127: ./app/assets/js/modulos/lista.usuario.js