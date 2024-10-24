<?php
session_start();
require_once 'conexion.php'; // Asegúrate de que este archivo de conexión esté configurado correctamente

// Verificar si hay un usuario en la sesión
if (!isset($_SESSION['usuario'])) {
    die("No hay usuario en la sesión.");
}

$usuario_id = $_SESSION['usuario']; // Aquí debería ser 1 si Josiaz ha iniciado sesión

// Depuración de la sesión
echo "ID de usuario en la sesión: " . $usuario_id . "<br>";

// Verificar si el formulario fue enviado con el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $tarjeta = $_POST['tarjeta'] ?? '';
    $expiracion = $_POST['expiracion'] ?? '';
    $cvv = $_POST['cvv'] ?? '';
    $metodo = $_POST['metodo'] ?? '';
    $total = floatval($_POST['total'] ?? 0);

    // Validar que todos los campos están llenos y que el total sea válido
    if (empty($nombre) || empty($tarjeta) || empty($expiracion) || empty($cvv) || empty($metodo) || $total <= 0) {
        die("Error: Todos los campos son obligatorios y el total debe ser mayor que cero.");
    }

    // Conectar a la base de datos
    $conexion = new mysqli("localhost", "root", "root", "proyectosoftw");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar si el usuario existe en la tabla usuarios
    $query_usuario = "SELECT COUNT(*) FROM usuarios WHERE id = ?";
    $stmt_usuario = $conexion->prepare($query_usuario);
    $stmt_usuario->bind_param('i', $usuario_id);
    $stmt_usuario->execute();
    $stmt_usuario->bind_result($count);
    $stmt_usuario->fetch();
    $stmt_usuario->close();

    if ($count == 0) {
        die("Error: El ID de usuario no existe en la base de datos.");
    }

    // Obtener la fecha actual para insertar
    $fecha = date('Y-m-d H:i:s'); // Asegúrate de usar el formato correcto para tu base de datos

    // Insertar la orden en la tabla ordenes
    $query_orden = "INSERT INTO ordenes (id_usuario, fecha, total) VALUES (?, ?, ?)";
    $stmt_orden = $conexion->prepare($query_orden);
    $stmt_orden->bind_param('isd', $usuario_id, $fecha, $total);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt_orden->execute()) {
        echo "Orden creada con éxito.";
    } else {
        die("Error: No se pudo crear la orden. " . $stmt_orden->error);
    }

    // Obtener el ID de la orden recién creada
    $id_orden = $stmt_orden->insert_id;

    // Cerrar el statement de la orden
    $stmt_orden->close();

    // Insertar el pago en la base de datos
    $query_pago = "INSERT INTO pagos (id_orden, nombre_tarjeta, numero_tarjeta, fecha_expiracion, cvv, id_metodo_pago) 
                   VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_pago = $conexion->prepare($query_pago);
    
    // Convertir el ID del método de pago a un valor adecuado
    $id_metodo_pago = ($metodo === 'Tarjeta de Crédito/Débito') ? 1 : 2;

    // Asignar los valores a los placeholders del query
    $stmt_pago->bind_param('issssi', $id_orden, $nombre, $tarjeta, $expiracion, $cvv, $id_metodo_pago);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt_pago->execute()) {
        echo "Pago realizado con éxito.";
    } else {
        die("Error: No se pudo procesar el pago. " . $stmt_pago->error);
    }

    // Cerrar la conexión y liberar el statement
    $stmt_pago->close();
    $conexion->close();
}
?>
