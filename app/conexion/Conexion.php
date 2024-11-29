<?php

//primer paso: crear el archivo conexion para establecer una conexion a la base de datos
//segundo paso: dentro del archivo diseñar una clase mendiante la cual se gestionara la conexion a la BD
class Conexion {

    //definimos los atributos

    private $conexion; //atributo que guardara la referencia PDO que se realizara

    private $confinguracion = [ // atributo donde guardaremos la configuracion de nuestra BD a utilizar
                            "driver" => "mysql" ,        //es el que nos permite comunicarnos con el motor de base de datos
                            "host" => "localhost" ,      //el host  que aloja la BD en local puede ser localhost ó 127.0.0.1
                            "database" => "crud1" ,      //el nombre de la base de datos a donde buscamos conectarnos
                            "port" => "3306" ,           //puerto de entrada o conexion a la BD, para XAMPP el por defecto 3306
                            "username" => "root" ,       //usuario que aministra la base de dato de interes
                            "password"=> "" ,            //contraseña de acceso del usuario al gestor
                            "charset" =>"utf8mb4"      /*condificacion de caracteres que se utilizara en 
                                                        las transacciones/consultas con las BD*/
                            ] ; 

    public function __construct () { /*3° paso: definmos el construct para poder generar 
        un objeto "vacio" al momento de instanciar*/
        
    }

    public function conectar () {

        /* try-catch controla la operacion que se relizan donde el bloque de operaciones principal se determina en el try
        y en caso de haberse dado un error en la ejecucion, este pasa al catch donde procede a dar ejecucion de los comandos
        que establescamos como medida en caso de errores
        try {
            //codigo...
        } catch (\Throwable $th) {
            //throw $th; es decir lo que ejecuto en caso de los errores arrojados 
        }*/


        try {   //4° paso: se definira un try- catch donde estableceremos los parametros de la conexion
                //se definen en variables por separado la informacion contenida en el atributo conexion

            $controller = $this -> confinguracion ["driver"];
            $server = $this -> confinguracion ["host"];
            $database = $this -> confinguracion ["database"];
            $port = $this -> confinguracion ["port"];
            $username = $this -> confinguracion ["username"];
            $password = $this -> confinguracion ["password"];
            $charset = $this -> confinguracion ["charset"];

            $url = "{$controller}:host={$server}:{$port};"."dbname={$database};charset={$charset}";
            /*
            Se debe tener mucho cuidado con la estructura de la url ya que si existe un error de sintaxis puede el gestor
            interpretar que hubo la conexion pero no encontrar la base de datos
            
            adjunto un link donde se detalla a mayor profundidad el porque se sigue esta 
            estructura para indicar la ruta de la conxecion de la base de datos.
            
            https://www.kodetop.com/conectar-php-con-base-de-datos-utilizando-pdo/            
            */

            //5° paso se crea o establece la conexion

            $this->conexion = new PDO($url, $username, $password);/*La extensión Objetos de Datos de PHP (PDO por sus
             siglás en inglés) define una interfaz ligera para poder acceder a bases de datos en PHP.
             https://www.php.net/manual/es/intro.pdo.php
             */

            //echo "CONECTADO"; //SE PROCEDE  PROBAR LA CONEXION paso 6
            //ir al index y ver el paso 7 para ver como se puede probar la conexion

            return $this->conexion; /*paso 8 una vez probada la conexion puedo comentar o eliminar el codigo de prueva
            y paso a retornar la conexion a la BD que es el objetivo de este metodo conectar
            */

        } catch (Exception $exc) {    /*mediante el uso de la palabra reservada Exception almaceno la informacion que fue
            recabadapor el compilardor como errores en la ejecuacion del sistema y defino una variable $exc que recopile toda 
            la informacion de los errores   */
            
            echo "NO SE PUDO CONECTAR </br>";
            echo "<par>";
            echo $exc ->getTraceAsString(); /* devuelve la informacion recopilada por medio de una Exception como una cadena
            de caracteres. Esta informacion va a ser secuencial en base a como fueron apareciendo los errores, es decir, los
            errores ordenado en orden de aparicion*/
            echo "</par>";
        }


    }

}

?>