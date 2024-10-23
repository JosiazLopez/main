<?php
session_start();
require_once 'conexion.php'; // Asegúrate de tener tu archivo de conexión correctamente configurado

// Recoger los datos del formulario
$nombre = $_POST['nombre'];
$tarjeta = $_POST['tarjeta'];
$expiracion = $_POST['expiracion'];
$cvv = $_POST['cvv'];
$metodo = $_POST['metodo'];
$total = $_POST['total'];

// Validar que todos los campos estén llenos
if (empty($nombre) || empty($tarjeta) || empty($expiracion) || empty($cvv) || empty($metodo)) {
    die("Por favor completa todos los campos.");
}

// Obtener el id del método de pago
$query_metodo = "SELECT id FROM metodos_pago WHERE metodo = ?";
$stmt_metodo = $conexion->prepare($query_metodo);
$stmt_metodo->bind_param('s', $metodo);
$stmt_metodo->execute();
$result_metodo = $stmt_metodo->get_result();
if ($result_metodo->num_rows > 0) {
    $fila_metodo = $result_metodo->fetch_assoc();
    $id_metodo_pago = $fila_metodo['id'];
} else {
    die("Método de pago no encontrado.");
}

// Insertar el pago en la base de datos (asumiendo que tienes una orden activa con id_orden)
$id_orden = $_SESSION['id_orden']; // O lo puedes recibir a través de una URL o POST
$query_pago = "INSERT INTO pagos (id_orden, nombre_tarjeta, numero_tarjeta, fecha_expiracion, cvv, id_metodo_pago) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_pago = $conexion->prepare($query_pago);
$stmt_pago->bind_param('issssi', $id_orden, $nombre, $tarjeta, $expiracion, $cvv, $id_metodo_pago);

if ($stmt_pago->execute()) {
    echo "Pago realizado con éxito.";
    // Redirigir a una página de confirmación o resumen del pedido
} else {
    echo "Error al procesar el pago: " . $stmt_pago->error;
}

$stmt_metodo->close();
$stmt_pago->close();
$conexion->close();
?>	