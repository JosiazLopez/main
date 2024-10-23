<?php
$host = "localhost"; // Cambia si tu servidor es diferente
$usuario = "root"; // Usuario de MySQL
$contraseña = "root"; // Contraseña de MySQL (déjala vacía si no tienes)
$base_de_datos = "ProyectoSoftw"; // Nombre de tu base de datos

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar si la conexión tuvo éxito
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
