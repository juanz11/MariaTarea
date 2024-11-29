<?php 

/*

OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    OJO    

OBSERVACION TODOS LOS EJEMPLO QUE SE DAN HASTA EL PASO 43 SIGUEN UNA ESTRUCTURA DE CARPETAS SIMPLE
DEBEN DE OBSERVAR LAS RUTA QUE SE MANEJABAN ANTES DE LA REORGANIZACION DEL PROYECTO DEBIDO A UNA REESTRUTURACION 
QUE SE EXPLICA A PARTIR DEL PASO 44

si quiere seguir PASO a PASO la creaccon del proyecto debe de AJUSTAR las rutas de los archivos a la estructura de carpetas
que UTILICE

toda las pruebas son funcionales en el Paso CORRESPONDIENTE

*/


/* PASO 7 prueva de conexion 
require './conexion/Conexion.php';
$conexion = new Conexion(); //intanciamos a la clase conexion 
$conexion->conectar();     //instanciamos al metodo que establece la conexion para provar su funcionamiento 
 */


/* Paso 12 prueba de metodo get() de la clase Crud
require './conexion/Conexion.php';
require './modelo/crud.php';

$crud = new Crud("usuario");//para consultar otras tablas solamente habriamos que indicarle al metodo el nombre de dicha tabla
$lista = $crud->get();
echo "<pre>";
var_dump($lista);
echo "</pre>";
*/

/* paso 16 prueva del metod insert()
require './conexion/Conexion.php';
require './modelo/crud.php';

$crud = new Crud("usuario");
$id = $crud->insert([
    "nombres" => "Liam",
    "apellidos" => "Daniel",
    "edad" => 1,
    "correo" => "liam@gmail.com",
    "telefono" => "123",
    "fecha_registro" => date("Y-m-d H:i:s")
        ]);

echo "El ID INSERTADO ES: " . $id;
//se puede hacer use del metodo get() para observar su funcionamiento
echo "<br/>";
$lista = $crud->get();
echo "<pre>";
var_dump($lista);
echo "</pre>";*/


/* PASO 22 prueva del metod update()
require './conexion/Conexion.php';
require './modelo/crud.php';

    $crud = new Crud("usuario");
    $filasAfectadas = $crud->where("id", "=", 2)->update(["nombres" => "Liam Daniel",
                                                        "apellidos"=>"Lugo Leon"]);

    echo "FILAS AFECTADAS: " . $filasAfectadas;
    echo "<br/>";
    $lista = $crud->get();
    echo "<pre>";
    var_dump($lista);
    echo "</pre>"; */

/*PASO 23 prueva del metod delete() 
require './conexion/Conexion.php';
require './modelo/crud.php';

$crud = new Crud("usuario");

$eliminados = $crud->where("id", "=", 1)->delete();

echo  " ELIMINADOS: " . $eliminados; 
echo "<br/>";
$lista = $crud->get();
echo "<pre>";
var_dump($lista);
echo "</pre>"; */


/*PASO 34 pruebas del modelo usuarios.php*/

/*require './conexion/Conexion.php';
require './modelo/crud.php';
require './modelo/modeloGenerico.php';
require './modelo/usuarios.php';*/

/* forma 1 de consultar todos los elementos de la tabla mediante el modelo

$modelo = new Usuarios();
$lista = $modelo->get();

echo "<pre>";
var_dump($lista);
echo "</pre>";*/

/* forma 2 de consultar todos los elementos de la tabla mediante el modelo

echo "<pre>";
var_dump( (new Usuarios())->get() ); //intancio directamente al metodo que me arroja los resultados
echo "</pre>";          */

/*insertar usuario haceiendo uso de los metodos set
$modelo = new Usuarios();

$modelo->setNombres("Rafael Antonio");
$modelo->setApellidos("Leon Aguilera");
$modelo->setEdad(66);
$modelo->setTelefono(04141234);
$modelo->setCorreo("email@gmail.com");
$modelo->insert();
//invocamos al metodo insert para insertar en la tabla todos 
//los valores de los atributos que hemos establecido mediante los set

echo "<pre>";
var_dump( ( new Usuarios() )->get() );
echo "</pre>";
*/

/*cosultar o burcar un registro en la tabla

$modelo = new Usuarios();
$registro = $modelo->where("correo", "=", "email@gmail.com")->get();

echo "<pre>";
var_dump($registro);
echo "</pre>"; */


/*PASO 37 prueba del controlador 
require './conexion/Conexion.php';
require './modelo/crud.php';
require './modelo/modeloGenerico.php';
require './modelo/usuarios.php';
require './controlador/ControladorUsuarios0.php';

$controladorUsuarios = new ControladorUsuarios();
$respuesta = $controladorUsuarios->insertarUsuario([
    "nombres" => "JJ2",
    "edad" => 22,
    "email" => "email3@gmail.com",
    "asdfasfda" => "sdfasdfa"
]);
$usuario = [
    "idUsuario" => 6,
    "correo" => "correo@gmail.com",
    "telefono" => "123456789"
];
$respuesta = $controladorUsuarios->actualizarUsuario($usuario);
var_dump($respuesta);
echo "<br/>";

$respuesta = $controladorUsuarios->eliminarUsuario(6);
var_dump($respuesta);
echo "<br/>";

$respuesta = $controladorUsuarios->buscarUsuarioPorId(6);
var_dump($respuesta);
echo "<br/>";

echo "<br/>";
$respuesta = $controladorUsuarios->listarUsuarios();
var_dump($respuesta);

*/

/*PASO 43 prueba del controlador ACTUALIZANDO LOS MENSAJES 
require './conexion/Conexion.php';
require './modelo/crud.php';
require './modelo/modeloGenerico.php';
require './modelo/usuarios.php';
require './controlador/ControladorUsuarios.php';
require './constantes/EMensajes.php';
require './controlador/Respuesta.php';
 
$controladorUsuarios = new ControladorUsuarios();
$respuesta = $controladorUsuarios->listarUsuarios()->json();

/*luego de instaciar la lista podemos enviar esa lista al metodo json() para que de el formato del objeto que tiene todos los
registros de la tabla y lo vuela una representación JSON * / 

echo ($respuesta);



/*AHORA como podemos observar necesitamos incluir cada una de las rutas de nuestro archivo en el index.php o en su defecto
en cada archivo que necesitemos los modulos de interes. En este ejemplo que nada mas estamos trabajando con UNA(1) unica tabla
ya vemos que nos leva 7 lineas ahora imaginemos esto en un proyecto real nuestras solicitudes de archivos facilmente puede
llevar mas de 20 lineas sin mencional que tendriamos que verificar EN CADA archivo nuestras solicitudes.

Para organizar mejor el codigo haremos uso de una herramienta conocida como Autoload que desarrollaremos en el PASO 44 dentro
de la carpeta src/autoloader/autoloader.php ahora ¿porque esta ruta?

La carpeta src o source (fuente)
*/


/*PASO 48 prueba del AUTOLOADER
require './src/Roots.php';
require PATH_SRC . 'autoloader/Autoloader.php';

/** Con este Autoloader tus clases (archivos .php) se impotarán automáticamente.
 * Solo debes tener encuenta que el nombre de la clase sea el mismo que el nombre 
 * del archivo.
 /
Autoloader::registrar();//llamo al metodo que me registra el Autoloader es NECESARIO para el funcionamiento

$controladorUsuarios = new ControladorUsuarios();

$respuesta = $controladorUsuarios->listarUsuarios()->json();
echo ($respuesta);*/

/*
    Luego del PASO 48 podemos tener N cantidad de rutas de archivos, rutas las cuales a medida que crece el proyecto
    seran reflejadas en la URL y sin una adecuada gestion esta URL es vulnerable a errores/ataques. Para evitar esto;
    y a su vez poder logar mejorar limpiar las URLs se generara un archivo donde se hara la llamada del autoload
    dicho archivo estara en la ruta ./src/launcher.php seguir esta ruta para seguir en el paso 49
*/


require './src/launcher.php';
