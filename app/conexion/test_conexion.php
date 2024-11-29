<?php
require_once 'conexion/Conexion.php'; // Asegúrate de que la ruta sea correcta

$conexion = new Conexion();
$conn = $conexion->conectar(); // Obtener la conexión

if ($conn) {
    echo "Conexión exitosa.<br>";

    // Leer usuarios
    $usuarios = $conexion->obtenerUsuarios();
    echo "Usuarios:<br>";
    foreach ($usuarios as $usuario) {
        echo "ID: " . $usuario['id'] . ", Nombre: " . $usuario['nombre'] . ", Email: " . $usuario['email'] . "<br>";
    }

    // Insertar un nuevo usuario (descomentar para probar)
    // $conexion->insertarUsuario('Juan Pérez', 'juan@example.com');
    // echo "Usuario 'Juan Pérez' insertado.<br>";

    // Actualizar un usuario (descomentar para probar, asegurándote de que el ID exista)
    // $conexion->actualizarUsuario(1, 'Juan Actualizado', 'juan_actualizado@example.com');
    // echo "Usuario con ID 1 actualizado.<br>";

    // Eliminar un usuario (descomentar para probar, asegurándote de que el ID exista)
    // $conexion->eliminarUsuario(1);
    // echo "Usuario con ID 1 eliminado.<br>";

} else {
    echo "No se pudo establecer la conexión.";
}
?>