<?php
/*paso 35 creacion del controlador que manejara las opreaciones entre los modelo y las vistas
en este ejemplo como nada mas tenemos la tabla usuario y su modelo se desarrollara el controlados para dicho modelo*/

/*los controladores denben de indentiricar pimero que son un controlador y segundo cual es el modelo con el que interactua
    ejemplo

    Tabla: -- usuario  --      Modelo: Usuarios.php          Controlador:    ControladorUsuarios.php
    Tabla: -- estudiante  --   Modelo: Estudiantes.php       Controlador:    ControladorEstudiantess.php
    Tabla: -- car  --          Modelo: Cars.php              Controlador:    CarsController.php
    Tabla: -- boat  --         Modelo: Boats.php             Controlador:    BoatsController.php

    AHORA bien el nombre dado a este archivo es para evitar saturar aun mas los comentarios
    desarrollare un modificacion futura "masiva" de los metodos de este controlador en otro archivo
*/

class ControladorUsuarios0 {//Se crea el controladorUsuarios.php

    function __construct() {
        
    }

    /*PASO 36 definimos los metodos para insertar listarUsuario actualizarUsuario buscarUsuario y eliminarUsuario 
    si bien pareciera que estamos repitiendo procesos en este caso intregamos en los metodos logica mas compleja de validacion
    he incluso mensajes de errores acorede a la circuntancia o mensajes de exito
    */

    public function insertarUsuario($usuario) { 
        $usuarioModel = new Usuarios();// Hacemos una instancia al método usuario que maneja el controlador usuario

        $id = $usuarioModel->insert($usuario);//Obtenemos el ID desde el crud mediante el método insert al cual se le pasa el objeto usuario

        return [//retornamos un objeto con los atributos necesarios para validar si se dió adecuadamente la operación. Así mismo como arroja el mensaje de error correspondiente

            "codigo" => (($id > 0) ? 1 : -1),// un codigo que es si se logro la oprecion
            "mensaje" => ($id > 0) ? "Se ha insertado el usuario correctamente" : "No se pudo insertar el usuario.",//mesaje en base al resutado de la operacion
            "datos" => $id//datos referente a la opreacion o aquellos que se busca obtener en este caso el ID del usuario añadido
        ];
    }

    public function listarUsuarios() {
        $usuarioModel = new Usuarios();
        $lista = $usuarioModel->get();//obtenemos la lista de usua
        return [
            "codigo" => ((count($lista) > 0) ? 1 : -1),
            "mensaje" => ((count($lista) > 0) ? "Se han consultado los registros correctamente." : "No hay registros."),
            "datos" => $lista//datos referente a la opreacion o aquellos que se busca obtener en este caso el listado de todos los registro de la tabla ususario
        ];
    }

    public function actualizarUsuario($usuario) {
        $usuarioModel = new Usuarios();
        $actualizados = $usuarioModel->where("id", "=", $usuario["idUsuario"])
                ->update($usuario);//relizamos una atualizacion mediante una condicion que recibimos en el objeto
        return [
            "codigo" => (($actualizados > 0) ? 1 : -1),
            "mensaje" => ($actualizados > 0) ? "Se ha actualizado el usuario correctamente." : "No se pudo actualizar el usuario.",
            "datos" => $actualizados //datos de la consuta de la actualizacion de usuario
        ];
    }

    public function eliminarUsuario($idUsaurio) {
        $usuarioModel = new Usuarios();
        $eliminados = $usuarioModel->where("id", "=", $idUsaurio)->delete();
        return [
            "codigo" => (($eliminados > 0) ? 1 : -1),
            "mensaje" => ($eliminados > 0) ? "Se ha eliminado el usuario correctamente." : "No se pudo eliminado el usuario.",
            "datos" => $eliminados //datos sobre si se logro o no eliminar el registro de la tabla usuario
        ];
    }

    public function buscarUsuarioPorId($idUsuario) {
        $usuarioModel = new Usuarios();
        $usuario = $usuarioModel->where("id", "=", $idUsuario)->first();
        return [
            "codigo" => (($usuario != null) ? 1 : -1),
            "mensaje" => ($usuario != null) ? "Se ha consultado el usuario correctamente." : "No se pudo consultar el usuario.",
            "datos" => $usuario //informacion del registro de la tabla usuario buscado
        ];
    }

}
