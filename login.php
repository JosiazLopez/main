<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar si se seleccionó "Recordarme"
    if (isset($_POST['recordarme'])) {
        setcookie("usuario", $nombre_usuario, time() + (86400 * 30), "/"); // 30 días
    } else {
        setcookie("usuario", "", time() - 3600, "/"); // Borrar cookie si no se selecciona "Recordarme"
    }

    // Consultar la base de datos
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?");
    $stmt->bind_param("ss", $nombre_usuario, $contrasena); // "ss" son dos strings: nombre_usuario y contrasena
    
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // ¡Inicio de sesión exitoso!
        header("Location: index.html"); // Redirigir a index.html
        exit(); // Asegúrate de usar exit() después de header() para detener la ejecución del script
    } else {
        echo "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
    $conexion->close();
}
?>
