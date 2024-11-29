<?php
/*paso 9 generamos un archivo crud.php dentro de la carpeta modelo que se encargara de las funciones
generales CRUD en la base de datos iniciamos una clase que contendra todos los metodos CRUD
*/

class Crud {
    //establecemos los atributos de la clase
    protected $tabla; //almacena datos de la tabla de la BD a trabajar
    protected $conexion; //alamacena datos de conexion 
    protected $wheres= ""; //recopila todas las condiciones de consulta a la BD
    protected $sql= null;   //repocila las consultas e intrucciones que se haran a la BD

    public function __construct($tabla = null)/*paso 10 se genera el contrucctor donde recibo el nombre de la 
    tabla que indico que puede se vacio*/
    {
        $this->conexion= (new Conexion())->conectar(); /*se instancia a la clase conexion y a su vez se invoca el metodo conectar
        de esta manera obtenemos la instancia de la coneccion que devuelve el metodo conectar. Esto permite que el atrivito conexionn contenga
        todos los datos necesarios para la conexion a la BD
        */
        /* $this->conexion= (new Conexion()) parte del principio de:  $variable = (new CLASE())->metodo();
        que lo que busca es intanciar al metodo mientras se accesde directamente a un metodo que contiene dicha clase
        esto permite de crear un objeto del tipo de la clase con los valores inmediatos que arroja o produce el metodo.
        esto nomalmente se realiza para evitar la aglomeracion de variables para acceder a 1 unico metodo de la clase. */

        $this->tabla=$tabla; // instanciamos el nombre de la tabla que recibimos, bajo la cual se va a trabajar

    }

    public function get(){/*paso 11 procedemos a definir el metodo get() el cual nos permitira obtener TODOS
        los registros de UNA (1) tabla dentro de nuestra base de datos*/
   
        try { //dentro de un try-catch  primero intanciamos el atributo sql
            
            $this->sql = "SELECT * FROM {$this->tabla} {$this->wheres}"; /*este va a almacenar la consulta donde seleccionamos
            todos los achivos de la tabla, inclusive si hay una condicicon para seleccionarlos*/

            $sth = $this->conexion->prepare($this->sql); /*PDO::prepare metodo reservado PDO dado la conexion fue establecida bajo parametro PDO
              — Prepara una sentencia para su ejecución y devuelve un objeto sentencia*/

            $sth->execute(); /*enviamos la sentencia preparada a un metodo que sera el encargado de ejecutar la sentencia y 
            recopilar los resultados que de la base de datos*/

            return $sth->fetchAll(PDO::FETCH_OBJ);//organizamos la informacion consultada en objetos con la estructura de la tabla
            //para provar dicho metodo visualizar el ejemplo en index.php PASO 12

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            
        }     

    }

    public function insert($obj) {//PASO 13 definimor el metodo insert() que nos permite insertar elementos en la BD
        try {
            // teclas: alt + 96= (`) 
            /* implode() permite unir elementor de un array en una cadena con parametros especificos añadiendo 
            un elemento que junta o "pega" cada elemento del array
            https://www.php.net/manual/es/function.implode.php 
            https://andresledo.es/php/implode/
            */

            $campos = implode("`, `", array_keys($obj)); // me permiete obtener este patron: nombre`, `apellido`, `edad 

            $valores = ":" . implode(", :", array_keys($obj)); //me permiete obtener este patron :nombre, :apellido, :edad

            $this->sql = "INSERT INTO {$this->tabla} (`{$campos}`) VALUES ({$valores})"; //estruturo la consulta a la BD

            $this->ejecutar($obj); //invodo a un metodo ejecutar() que se define para que ejecute la consulta cuya estrutura se definio en el metodo

            $id = $this->conexion->lastInsertId();// de esta manera obtengo el id del ultimo objeto insertado a la BD

            return $id;//una vez completados los pasos 13, 14 y 15 se puede probar mediante el paso 16 comentado en el index.php

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function ejecutar($obj = null) { //PASO 14 definimos el metodo ejecuta() que hara la el envio de la consuta SQL
        $sth = $this->conexion->prepare($this->sql);//preparamos la consulta SQL para usarse en PDO
        if ($obj !== null) { //verificamos que se halla recibido un objeto
            foreach ($obj as $llave => $valor) { //evaluamos recorriendo cada atributo/llave del objeto sus valores
                if (empty($valor)) {//en caso de que un atributo no eset definido se establece cono NULL
                    $valor = NULL;
                }
            $sth->bindValue(":$llave", $valor); //PDOStatement::bindValue — Vincula un valor a un parámetro  https://www.php.net/manual/es/pdostatement.bindvalue.php
                            }
        }
        $sth->execute(); //procedemos a usar el metodo PDO reservado execute(); para hacer la consulta a la BD
        $this->reiniciarValores();//llamamos un metodo para reiniciar los valores de los atributos para evitar errores dentro del crud y permitirme hacer otra consulta en el mismo objeto 
        return $sth->rowCount();
    }

    private function reiniciarValores() { //paso 15 definimos un metodo que reinicie los atributos de la clase luego de cada ejecucion
        $this->wheres = "";
        $this->sql = null;
    }

    public function update($obj) {
        //PASO 17 una vez establecidos los metodos ejecutar() y reiniciarValores() seguimos con el metodo update()
        
        try {
            $campos = ""; //definimos una variable que contendre los campos que se reciben del objeto, este es un string vacio

            foreach ($obj as $llave => $valor) {//recorremos el objeto

                $campos .= "`$llave`=:$llave,"; //`nombres`=:nombres,`edad`=:edad  esta es la estrutura que obtenemos de los CAMPOS del objeto

            }

            $campos = rtrim($campos, ","); // quitamos la ultima (,) que quedara en la estrutura por la repeticion

            $this->sql = "UPDATE {$this->tabla} SET {$campos} {$this->wheres}";//asignamos la sentencia SQL que enviaremos a la BD

            $filasAfectadas = $this->ejecutar($obj); //mandamos la consulta a la BD mediante el metodo ejecutar() definido en el paso 14

            return $filasAfectadas; // puede ver como ser prueba este metodo en index.php PASO 22
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function delete() {//PASO 19 una vez establecidos los metodos ejecutar() y reiniciarValores()  se define el metodo delete()
        try {
            $this->sql = "DELETE FROM {$this->tabla} {$this->wheres}";//establecemos una consulta donde mediante una condicion
            // de busqueda ubicamos el elemento a eliminar de la BD

            $filesAfectadas = $this->ejecutar();//ejecutamos la consulta establecida

            return $filesAfectadas; // puede ver como ser prueba este metodo en index.php PASO 22

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function where($llave, $condicion, $valor) { //PASO 20 Establecemos los metodos where para 
        //condiciones AND necesarios para ubicar un registro en una tabla
        //hacemos uso de un OPERADOR CONDICIONAL TERNARIO o IF TERNARIO

        $this->wheres .= (strpos($this->wheres, "WHERE")) ? " AND " : " WHERE ";

        /* si (dentro del atributo wheres existe la cadena where) ? ENTONCES
         concatenamos " AND " SINO ENTONCES concatenamos " where ";
         esto con el objetivo de definir la condicion de busqued del registro y aprovechamos para concatenar el operador AND
          */

        $this->wheres .= "`$llave` $condicion " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " "; //estruturamos la senentecia de la condicion
        //validando si el valor es o no un string para definir el como sera enviado a la BD (con o sin comillas)

        return $this;
    }

    public function orWhere($llave, $condicion, $valor) { /*PASO 21 difinimos un nuevo metodo que sigue la estrutura del
        metodo where() pero concatenamos las condiciones en base al operador OR */

        $this->wheres .= (strpos($this->wheres, "WHERE")) ? " OR " : " WHERE ";

        $this->wheres .= "`$llave` $condicion " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " ";

        return $this;
    }

    
    public function first() {/* PASO 24 como parte del CRUD cuando buscamos un registro necesitamos en ciertos
        casos solamente el primer resultado que arroge una consulta, para ello refinimos el metodo first() 
        que obtiene una lista y dvuelte el primer valor de esta*/

        $lista = $this->get(); //obtengo una lista de valores de una tabla en base a unos parametros

        if (is_array($lista) && count($lista) > 0) { //verifico que la lista posee elementos y es un arreglo

            return $lista[0]; //retorno el primer elemento de la lista
            
        } else {
            return null; //si la lista no posee elementos indico que esta vacia
        }
    }



/*una vez finalizado el crud generico y las pruevas correspondientes en los paso 1 al 24
 tenemos un modelo CRUD que nos permite operar cualqueira sea la tabla de nuestra BD de nuestro interes */

    

}

?>