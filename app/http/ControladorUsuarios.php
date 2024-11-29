<?php
/*PASO 42 ACTUALIZAMOS cada metodo del controlador la definido en base a la Clase Respuesta */
class ControladorUsuarios {

    function __construct() {
        
    }

    public function insertarUsuario($usuario) {

        $usuarioModel = new Usuarios();
        $id = $usuarioModel->insert($usuario);
        $insersionExitosa = ($id > 0);//validamos si se logro o no la insercion

        //creamos una intancia de la clase respuesta donde en base a la verificacion del caso  que es validado previamente arrejamos el mensaje
        $respuesta = new Respuesta($insersionExitosa ? EMensajes::INSERCION_EXITOSA : EMensajes::ERROR_INSERSION);
        //mediante un If ternario verificamos SI se logro la incercion ENTONCES intanciamos Emensaje como exito de insercion SINO instanciamos como error

        $respuesta->setDatos($id);//y obtenemos los datos del ID insertado

        return $respuesta;
    }

    /*pasamos haciendo uso de retorna este objeto que complicaba la reutilizacion del codigo a una estrutura mas limpia
    return [//retornamos un objeto con los atributos necesarios para validar si se dió adecuadamente la operación. Así mismo como arroja el mensaje de error correspondiente

            "codigo" => (($id > 0) ? 1 : -1),// un codigo que es si se logro la oprecion
            "mensaje" => ($id > 0) ? "Se ha insertado el usuario correctamente" : "No se pudo insertar el usuario.",//mesaje en base al resutado de la operacion
            "datos" => $id//datos referente a la opreacion o aquellos que se busca obtener en este caso el ID del usuario añadido
        ];
    */

    public function listarUsuarios() {
        $usuarioModel = new Usuarios();
        $lista = $usuarioModel->get();
        $v = count($lista); //validamos si existe una lista

        $respuesta = new Respuesta($v ? EMensajes::CORRECTO : EMensajes::ERROR);
        //intanciamos y comprobamos cual de los mensaje es el adecuado en caso de haber valores en la lista

        $respuesta->setDatos($lista);//tomamos los datos de interes

        return $respuesta;
    }

    public function actualizarUsuario($usuario) {
        $usuarioModel = new Usuarios();
        $actualizados = $usuarioModel->where("id", "=", $usuario["idUsuario"])
                ->update($usuario);

        $v = ($actualizados > 0) ;//comprobamos si se logro la actualizacion

        $respuesta = new Respuesta($v ? EMensajes::ACTUALIZACION_EXITOSA : EMensajes::ERROR_ACTUALIZACION); //intanciamos las respuestas en base al caso adecuado

        $respuesta->setDatos($actualizados);
        return $respuesta;
    }

    public function eliminarUsuario($idUsaurio) {
        $usuarioModel = new Usuarios();
        $eliminados = $usuarioModel->where("id", "=", $idUsaurio)->delete();

        $v = ($eliminados > 0) ;//verificamos si hubo una eliminacion

        return new Respuesta($v ? EMensajes::ELIMINACION_EXITOSA : EMensajes::ERROR_ELIMINACION);//instanciamos la respuesta
        
        
    }

    public function buscarUsuarioPorId($idUsuario) {
        $usuarioModel = new Usuarios();
        $usuario = $usuarioModel->where("id", "=", $idUsuario)->first();

        $v = ($usuario != null) ;//verificamos si se encontro el usuario
        return new Respuesta($v ? EMensajes::CORRECTO : EMensajes::NO_HAY_REGISTROS);      

        
    }

}

?>