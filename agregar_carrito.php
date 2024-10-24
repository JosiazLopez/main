<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', 'root', 'proyectosoftw');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error al conectar a la base de datos: " . $conexion->connect_error);
}

// Verificar si ya existe un carrito en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();  // Inicializar el carrito si no existe
}

// Obtener el ID del carro desde la URL o formulario
$id_vehiculo = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_vehiculo) {
    // Consultar la base de datos para obtener los detalles del vehículo
    $query = "SELECT id, nombre, precio FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id_vehiculo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $vehiculo = $resultado->fetch_assoc();

        // Crear el ítem a agregar al carrito
        $carro = array(
            "id" => $vehiculo['id'],
            "nombre" => $vehiculo['nombre'],
            "precio" => $vehiculo['precio'],
            "cantidad" => 1
        );

        // Verificar si el carro ya está en el carrito
        $existe = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id'] == $id_vehiculo) {
                $item['cantidad'] += 1;  // Incrementar la cantidad si ya está en el carrito
                $existe = true;
                break;
            }
        }

        if (!$existe) {
            // Si no existe, añadir al carrito
            array_push($_SESSION['carrito'], $carro);
        }

        // Redireccionar a la página del carrito
        header("Location: ver_carrito.php");
    } else {
        echo "Error: El vehículo no existe en la base de datos.";
    }

    // Cerrar la consulta y la conexión a la base de datos
    $stmt->close();
} else {
    echo "Error: No se ha proporcionado un ID de vehículo válido.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
