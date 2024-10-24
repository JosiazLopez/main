<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "root", "proyectosoftw");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha solicitado eliminar un artículo del carrito
if (isset($_GET['action']) && $_GET['action'] == 'eliminar') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Validar que el ID no sea nulo y que exista en el carrito
    if ($id !== null && isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);

        // Reindexar el array para evitar problemas con los índices
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);

        // Verificar si el carrito está vacío después de eliminar el ítem
        if (empty($_SESSION['carrito'])) {
            unset($_SESSION['carrito']);
        }

        // Redireccionar para evitar problemas al actualizar la página
        header("Location: ver_carrito.php");
        exit();
    } else {
        echo "Error: No se pudo eliminar el vehículo del carrito.";
    }
}

// Verificar si se ha solicitado vaciar el carrito
if (isset($_GET['action']) && $_GET['action'] == 'vaciar') {
    unset($_SESSION['carrito']);
    // Redirigir después de vaciar el carrito
    header("Location: ver_carrito.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="carrito.css">
</head>
<body>
    <h1>Carrito de Compras</h1>
    <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Vehículo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total por Vehículo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_carrito = 0;
                foreach ($_SESSION['carrito'] as $id => $item):
                    $total_item = $item['precio'] * $item['cantidad'];
                    $total_carrito += $total_item;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                    <td>$<?php echo number_format($item['precio'], 2); ?></td>
                    <td><?php echo $item['cantidad']; ?></td>
                    <td>$<?php echo number_format($total_item, 2); ?></td>
                    <td>
                        <a href="ver_carrito.php?action=eliminar&id=<?php echo $id; ?>" class="buy-button">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total">
            <p><strong>Total del carrito: $<?php echo number_format($total_carrito, 2); ?></strong></p>
        </div>
        <center>
            <a href="ver_carrito.php?action=vaciar" class="empty-cart-button">Vaciar Carrito</a>
            <a href="pago.php?total=<?php echo $total_carrito; ?>" class="checkout-button">Proceder al Pago</a>
        </center>
    <?php else: ?>
        <p class="empty-cart-message">Tu carrito está vacío.</p>
    <?php endif; ?>

    <?php
    // Cerrar la conexión a la base de datos si se usó.
    if (isset($conexion) && $conexion instanceof mysqli) {
        $conexion->close();
    }
    ?>
</body>
</html>
