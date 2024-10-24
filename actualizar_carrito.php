<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data && isset($data['producto']) && isset($data['producto']['nombre']) && isset($data['producto']['precio'])) {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        $productoExistente = false;

        foreach ($_SESSION['carrito'] as $index => $carritoProducto) {
            if ($carritoProducto['nombre'] === $data['producto']['nombre']) {
                $_SESSION['carrito'][$index]['cantidad'] += 1;
                $productoExistente = true;
                break;
            }
        }

        if (!$productoExistente) {
            $producto = array(
                'nombre' => $data['producto']['nombre'],
                'precio' => $data['producto']['precio'],
                'cantidad' => 1
            );
            $_SESSION['carrito'][] = $producto;
        }

        echo json_encode(['status' => 'success', 'message' => 'Producto agregado al carrito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en los datos enviados']);
    }
} elseif (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['index'])) {
    $index = $_GET['index'];
    if (isset($_SESSION['carrito'][$index])) {
        $producto = $_SESSION['carrito'][$index];
        $_SESSION['carrito'][] = $producto;

        header('Location: carrito.php');
    }
} elseif (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['index'])) {
    $index = $_GET['index'];
    if (isset($_SESSION['carrito'][$index])) {
        unset($_SESSION['carrito'][$index]);
    }
    header('Location: carrito.php');
} else {
    http_response_code(405);
}
?>
