<?php

class Usuarios extends ModeloGenerico {//heredamos los metodos ModeloGenerico
    /*
    para hacer uso de los metodos de la clase ModeloGenerico los atributos deben de llamarse de manera identica a como estan establecido
    en nuetra base de datos, esto ademas de permitirnos reciclar codigo mediante el modeloGenerico.php cumple con la definicion de que el
    Modelo es una maquetacion en el codigo de nuestra tabla en la BD
    */

    //PASO 31 definimos los atributos con el nombre exacto que establecimos en la BD
    protected $id;
    protected $nombres;
    protected $apellidos;
    protected $edad;
    protected $correo;
    protected $telefono;
    protected $fecha_registro;


    //paso 32 construimos el objeto en base al metodo heredado de ModeloGenerico
    public function __construct($propiedades = null) {

        parent::__construct("usuario", Usuarios::class, $propiedades);
        /*Heredamos el construtor el métodoGenerico. Le tenemos que pasar el nombre exacto
         de la tabla en la BD, el nombre de la clase indicándole que es de tipo clase y las
         propiedades añadidas en la instanciacion*/

    }


    //PASO 33 definimos los métodos set (establecer valor) y get (obtener valor) para cada atributo de la clase
    function getId() {
        return $this->id;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEdad() {
        return $this->edad;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getFecha_registro() {
        return $this->fecha_registro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setFecha_registro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }

}

/* apasamos a provar en index.php*/
?>