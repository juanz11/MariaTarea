<?php
/*PASO 42 ACTUALIZAMOS cada metodo del controlador la definido en base a la Clase Respuesta */
class ControladorUsuarios extends Controller {

    function __construct() {
        
    }

    /*public function insertarUsuario($usuario) {

        $usuarioModel = new Usuarios();
        $id = $usuarioModel->insert($usuario);
        $insersionExitosa = ($id > 0);//validamos si se logro o no la insercion

        //creamos una intancia de la clase respuesta donde en base a la verificacion del caso  que es validado previamente arrejamos el mensaje
        $respuesta = new Respuesta($insersionExitosa ? EMensajes::INSERCION_EXITOSA : EMensajes::ERROR_INSERSION);
        //mediante un If ternario verificamos SI se logro la incercion ENTONCES intanciamos Emensaje como exito de insercion SINO instanciamos como error

        $respuesta->setDatos($id);//y obtenemos los datos del ID insertado

        return $respuesta;
    }*/

     /*pasamos haciendo uso de retorna este objeto que complicaba la reutilizacion del codigo a una estrutura mas limpia
    return [//retornamos un objeto con los atributos necesarios para validar si se dió adecuadamente la operación. Así mismo como arroja el mensaje de error correspondiente

            "codigo" => (($id > 0) ? 1 : -1),// un codigo que es si se logro la oprecion
            "mensaje" => ($id > 0) ? "Se ha insertado el usuario correctamente" : "No se pudo insertar el usuario.",//mesaje en base al resutado de la operacion
            "datos" => $id//datos referente a la opreacion o aquellos que se busca obtener en este caso el ID del usuario añadido
        ];
    */

    public function insertarUsuario(Request $request) {//PASO 103 recibimos por parametro un objeto Request ($_REQUEST), clase YA definida

        $usuarioModel = new Usuarios();//instanciamos al modelo Usuario para acceder a la tabla dentro de la BD

        $usuario = $usuarioModel->where("correo", "=", $request->correo)->first();
        //y buscamos en la tabla si hay algun usuario donde el correo sea igual al recibido por el formulario
        //tenere presentes que el valor de $request->correo es el mismo que el ingresado en el formulado cuyo id="correo"

        if ($usuario) {
        //si existe el correo indicamos que ya hay un usuario con ese correo mediante un return para
        // terminar la ejecucion del metodo
            return new Respuesta(EMensajes::ERROR, "El correo ya se encuntra registrado.");
        }

        $id = $usuarioModel->insert($request->all());//obtenemos el id del usario insertado
        
        $v = ($id > 0); //validamos si se logro o no la insercion

        //creamos una intancia de la clase respuesta donde en base a la verificacion del caso  que es validado previamente arrejamos el mensaje
        $respuesta = new Respuesta($v ? EMensajes::INSERCION_EXITOSA : EMensajes::ERROR_INSERSION);

        $respuesta->setDatos($id);//obtenemos los datos del ID insertado
        return $respuesta;
    }

   

    public function listarUsuarios() {
        $usuarioModel = new Usuarios();
        $lista = $usuarioModel->get();
        $v = count($lista); //validamos si existe una lista

        $respuesta = new Respuesta($v ? EMensajes::CORRECTO : EMensajes::ERROR);
        //intanciamos y comprobamos cual de los mensaje es el adecuado en caso de haber valores en la lista

        $respuesta->setDatos($lista);//tomamos los datos de interes

        return $respuesta;
    }
        
    public function index() {//PASO 76 defino el metodo de inicio 
        return $this->view("welcome"); //indico que en la ruta de las vistas busco el archivo welcome
        //para ello creo el archivo ./resources/view/welcome.php 
    }

    //PASO 101
    public function formCrearUsuario() {//indico la ruta de la vista para el registro de usuarios
        return $this->view("usuarios/registrarusuario");
    }

    public function formEdicionUsuario($id) {//PASO 110 indico la ruta de la vista para la actualizacion de usuarios
        $variables = [

            "titulo" => "Actualizar USUARIO con AJAX", //estableco una variaque en al ser enviada cambia el nombre de la pagina

            "idUsuario" => base64_decode($id)//decodifico el valor del id que estaba en base64 para poder utilizarlo
        ];
        //como para actualizar los datos necesito de hacer uso del formato con el que se registro puedo reciclar la vista del formulario de registro
        return $this->view("usuarios/registrarusuario", $variables);
    }

    //PASO 114 ACTUALIZACION DE LOS METODOS PARA ELIMINAR, ACTUALIZAR BUSCAR USUARIOS Y LA CREACCION DEL METODO eliminarUsuarioPorId()
    //todos estos metodo resiven ahora es un objeto Request que viene desde la transferencia http $_REQUEST

    public function buscarUsuarioPorId(Request $request) {
        
        $idUsuario = $request->idUsuario;
        /*esta variable que defino mediante los datos del $_REQUEST es la que se utilizara 
        para buscar mediante el AJAX en la BD  y se usara como parametro en la llamada a la ruta*/


        $usuarioModel = new Usuarios();
        $usuario = $usuarioModel->where("id", "=", $idUsuario)->first();//busco un usuario cuyo id cohincida con el solicitado
        $v = ($usuario != null);

        //asigno la respuesta del servidor en una variable instanciada
        $respuesta = new Respuesta($v ? EMensajes::CORRECTO : EMensajes::NO_HAY_REGISTROS);
        
        //a dicha instancia de Respuesta le intancio el metodo para asignarle los datos recibidos
        $respuesta->setDatos($usuario);
        //estos datos son necesarios ya que nos serviran para volver a llenar los formularos una ejecutada una accion


        //devuelvo el objeto con el mensaje adecuado y los datos correspondientes
        return $respuesta; 
    }

    public function actualizarUsuario(Request $request) {
        $usuarioModel = new Usuarios();
        $actualizados = $usuarioModel->where("id", " = ", $request->idUsuario)
                ->update($request->all());//busco el usuario cuyo id cohincida con el de la tabla y lo actualizo con la informacion recibida
        $v = ($actualizados >= 0);
        return new Respuesta($v ? EMensajes::ACTUALIZACION_EXITOSA : EMensajes::ERROR_ACTUALIZACION);
    }

    public function eliminarusuario($idUsuario) {
        $usuarioModel = new Usuarios();
        $eliminados = $usuarioModel->where("id", " = ", $idUsuario)->delete();//busco y elimino usuario por medio del id
        $v = ($eliminados > 0);
        return new Respuesta($v ? EMensajes::ELIMINACION_EXITOSA : EMensajes::ERROR_ELIMINACION);
    }

    

    public function eliminarUsuarioPorId(Request $request) {
        $idUsuario = $request->idUsuario;
        $usuarioModel = new Usuarios();
        $filasFectadas = $usuarioModel->where("id", "=", $idUsuario)->delete();
        $respuesta = new Respuesta($filasFectadas > 0? EMensajes::CORRECTO : EMensajes::ERROR);
        return $respuesta;
    }

}

?>