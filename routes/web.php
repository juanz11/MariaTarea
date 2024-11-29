<?php
/*dentro de este archivo definiremos TODAS las rutas validas de acceso del sistemas*/



/* PASO 61

//se puede comprobar recibiendo parametro por GET (via url), escribiendo
la direccion que se indica entre " " y las variables o datos que queramos*/

/*
Route::get("/",function(){
    return "Hola Mundo desde una ruta";
});

Route::get("/saludame/:nombre/:apellido", function($nombre, $apellido, Request $request){
    return "Hola: " . $request->nombre." ".$request->apellido;
});

Route::get("/nombrecompleto",function(Request $request){
    //$_GET["nombre"]; en ves de usar esta variable para obtemer datos pór la URL
    return "Hola". $request->nombre." ".$request->apellido;
});



//asi mismo podemos recibir datos por POST (cuerpo del sistema)




*/

/*parametrización de las ruta de clases
Route::"MetodoHTTP"("URL",NombreClase::class."@nombreMetodoAUtilizar");

Podemos observar que nuestro llamado de clase esta compuesto de varios elementos para hacer uso de
funciones o metodos de una clase YA definida, al momento de definir una URL de un proyecto

Primero esta la "Route::" que no es mas que el instanciamiento de la clase Route ubicada en ./src/router/Route.php  
que definimos para poder contruir las URL en base a las URIs del proyecto, esplicada entre los pasos 51 al 60

segidamente definimos el metodo HTTP mediante el cual enviamos dato a dicha clase que vamos a instanciar

continuamos ya ahora si definiendo las "URL" que queremos usar dentro del proyecto

e inmediatamente definimo la clase a utilizar usando el "NombreClase" que hemos definido y este debe de coincidir 
a su declaracion, sino el proyecto no lograra ubicar dicho archivo de interes

ademas podemos hacer uso directo de un metodo especifico dentro de dicha clase mediante la estrutura de ."@nombreMetodo"
esto debido a que PHP lo que hace es devolver una cadena URI al invocar la clase y mediante la concatenacion añadimos a dicha
cadena el metodo o funcion a utilizar. Cave señalar que asimismo con en el llamado a la clase, la llamada al metodo debe de
conhincidir con el declarado en su defecto el proyecto no localizara el metodo de interes y se producira errores

*/

//PASO 75 estableco una ruta de prueba. hay que RECORDAR que si la URL inicia con "/" se buscara el metodo 
//index dentro de la clase para ello vamos a ./app/http/ControladorUsuarios.php  definimos el metod y se aprovecha para definir la vista 
Route::get("/", ControladorUsuarios::class); 
//paso 78 tambien puedo probar el llamado directo de un controlador y probar el parseo a CamelCase
Route::get("/listar_usuarios", ControladorUsuarios::class);


// PASO 100 añado la ruta para crear un usuario hay que definir el metodo formCrearUsuario en el controlador PASO 101 ./app/http/ControladorUsuarios.php
Route::get("/usuarios/form/crear", ControladorUsuarios::class."@formCrearUsuario");

//PASO 110 establezco la ruta para la edicion de registros enviando el id del registro que quiero editar
Route::get("/usuarios/form/edicion/:id", ControladorUsuarios::class."@formEdicionUsuario");

//RECURSOS PASO 102 definimos por metodo POST el envio de datos que captura los formularios al metodo correspondiente en el controlador
Route::post("/usuarios/registrar", ControladorUsuarios::class."@insertarUsuario");
//recordemos que el nombre del metodo debe de cohincidir con el declarado dentro de la clase

//PASO 115 genero una ruta para la Actualizacion del usuario desde el metodo del controlado usuario
Route::post("/usuarios/actualizar", ControladorUsuarios::class."@actualizarUsuario");
//tambien genero una ruta para el llamado del metodo que busca los usuarios por ID
Route::post("/usuarios/consultarUsuarioPorId", ControladorUsuarios::class."@buscarUsuarioPorId");

//PASO 121 se define la ruta para eliminar usuario por ID
Route::post("/usuarios/eliminarUsuarioPorId", ControladorUsuarios::class."@eliminarUsuarioPorId");