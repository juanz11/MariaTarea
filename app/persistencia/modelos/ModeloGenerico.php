<?php 
/*lo modelos son archivos que contienen todas las operaciones de interaccion con la base de datos
ya se diseño un archivo crud.php que posee todos los metodos generico crud segun sea la tabla. 
Mas ahora bien el diseño MVC (modelo-vista-controlador) establece los modelos como: aquel que se encarga de los datos, 
generalmente (pero no obligatoriamente) consultando la base de datos. Actualizaciones, consultas, búsquedas, etc. todo
eso va aquí, en el modelo. 
Tambien se establece que para cada tabla de la base de datos a la cual se conecta el sistema debe haber un modelo especifico
que opera sobre esta. Esto modelos por convecion toman el mismo nombre de la tabla de la DB pero en pluran (y normamente se usa en ingles)
ejemplo:
si la tabla se llama:   usuario             el modelo deberia ser: usuarios.php
si la tabla se llama:   reporte             el modelo deberia ser: reportes.php
si la tabla se llama:   vehicle             el modelo deberia ser: vehicles.php
si la tabla se llama:   student             el modelo deberia ser: students.php
*/ 

/*ahora bien normalmente los modelos poseen metodo muy identicos entre si, lo que conllevaria un gasto de tiempo en 
escribir codigo donde solamente cambia el nombre de las variables o los atribito. Para ello se desarrollara
un modeloGenerico que en base a la herencia podra ser utilizado por otras clases que modelan tabla de la BD
en especifica, permitiendo la utilizacion efetiva del codigo*/

class ModeloGenerico extends Crud {
    //PASO 25 definimos una clase ModeloGenerico que actuara como contenedor de los metodos comunes entre los modelos de la BD

    //definimos los atributos
    private $className; //nombre de la clase que esta dentro del metodo que usara el modelo generico

    private $excluir = ["className", "tabla", "conexion", "wheres", "sql", "excluir"]; /*excluirmos los parametos indicados*/

    function __construct($tabla, $className, $propiedades = null) {  /*PASO 26 generamos un construct que recibe los datos necesario
        para generar un objeto modelo identico a la estrutura de cualquier tabla de la BD*/
        //recibirmos el nombre de la tabla, el nombre de la clase del metodo, y las propiedades que pueden ser null

        parent::__construct($tabla);//llamamos el constructor padre de la clase CRUD, esto para indicar la tabla bajo la cual se va a trabajar

        $this->className = $className;//asignamos el nomrbe de la clase al objeto modelo que se instancia

        if (empty($propiedades)) {//si las propiedades o atributo del objeto que enviamos al contruc estan vacios retornamos el objeto
            return;
        }

        foreach ($propiedades as $llave => $valor) {// caso contrario, asignamos aquellos atributos y sus valores que no esten definidos en el modelo al objeto
            $this->{$llave} = $valor;
        }
    }

    protected function obtenerAtributos() { //PASO 27 metodo generico de obtencion de atributos

        $variables = get_class_vars($this->className);/*mediante el metodo de PHP get_class_vars() obtenemos los atributos de la clase {incluyenfo los 
        que son heredadores de las clases padres como CRUD o ModeloGenerico}, asi como la que estamos manejando
        */ 
        $atributos = []; //definimos un arreglo para almacenar

        $max = count($variables);//contamos el numero de elementos o atributos de la clase 

        foreach ($variables as $llave => $valor) { //recorremos el arreglo de los attributos

            if (!in_array($llave, $this->excluir)) {//comprobamos que la llave que se esta verificando no se encuentra en el arreglor excluir
                
                $atributos[] = $llave; /*lo añadamos al arreglo que contendra nuestros arreglos de interes, 
                mientras dejamos de lado los que pertenecen a la Clase CRUD y modeloGenerico */

            }
        }
        return $atributos;//retornamos unicamente los atributos de interes para el modelo
    }

    protected function parsear($obj = null) {
        /*PASO 28 definimos un metodo parsear() En programación, el parseo es el proceso de convertir una 
        secuencia de caracteres (código, datos, comandos) en una estructura sintáctica que un programa pueda
        entender y ejecutar.*/
        try {
            $atributos = $this->obtenerAtributos();/*e llama al método obtenerAtributos para 
            obtener los atributos del objeto clase (que pertenece al método de estudio)*/

            $objetoFinal = [];
            //Obtenes el objeto desde el modelo.


            if ($obj == null) {
                /*verificamos si recibimos un objeto nulo de ser el caso 
                intentamos armar un objeto en base a los valores de los atributos del objeto instanciado en la clase*/

                foreach ($atributos as $indice => $llave) {//recorremos cada elemento del objeto

                    if (isset($this->{$llave})) {//en base a si existe dentro de los atributos de la clase del modelo el mismo atributos que tiene el objeto

                        $objetoFinal[$llave] = $this->{$llave};//asignamos al objeto final el valor recibido por cada parámetro válido de la clase    

                    }
                }
                return $objetoFinal;
            }

            //Corregir el objeto que recibimos con los atributos del modelo.

            //Si llega el objeto tomamos los valores de los atributos o campos validos
            foreach ($atributos as $indice => $llave) {
                if (isset($obj[$llave])) {
                    $objetoFinal[$llave] = $obj[$llave];
                }
            }
            return $objetoFinal;
        } catch (Exception $ex) {
            //arrojamos todas las excepciónes identificando la clase del método que está buscando parsear el objeto
            throw new Exception("Error en " . $this->className . ".parsear() => " . $ex->getMessage());
        }
    }

    public function fill($obj) {
        //PASO 29 definimos un metodo que nos llena un objeto base a los atributos recibidos de un objeto
        try {
            $atributos = $this->obtenerAtributos();
            //Recibimos los atributos del objeto que pertenece a la clase


            foreach ($atributos as $indice => $llave) {
                if (isset($obj[$llave])) {
                    $this->{$llave} = $obj[$llave];
                    //Asignamos a los atributos de nuestro modelo aquellos que recibimos del objeto
                }
            }
        } catch (Exception $ex) {
            throw new Exception("Error en " . $this->className . ".fill() => " . $ex->getMessage());
        }
    }
    //PASO 30 ESTABLECEMOS UN METODO INSERT Y UPDATE que heredan del crud mas previamente parsea el objeto a evaluar
    public function insert($obj = null) {
        $obj = $this->parsear($obj);//Llamamos a parsear para preparar el objeto

        return parent::insert($obj);//retornamos una instancia del método padre insert de la clase crud.
    }

    public function update($obj) {
        $obj = $this->parsear($obj);//Llamamos a parsear para preparar el objeto
        return parent::update($obj); //retornamos una instancia del método padre update de la clase crud.
    }

    //establecemos un metodo __get y __set que reciben el nombre de un atributo cualquiera y busca o estable un valor en dicho atributo

    public function __get($nombreAtributo) {
        return $this->{$nombreAtributo};
    }

    public function __set($nombreAtributo, $valor) {
        $this->{$nombreAtributo} = $valor;
    }

}

/*YA DEFINIDO el modeloGenerico podemos hacer que los modelos expecifico
 hereden los metodos contenido para evitarnos el copiar innecesariamente lineas de codigo 
 
 los pasos continuan en el archivo /modelos/usuarios.php ya que para provar lo elaborado se debe estacer
un modelo que esquematice a una tabla de la BD
 */







 
?>