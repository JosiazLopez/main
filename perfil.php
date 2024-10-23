<?php
// Iniciar la sesión
session_start();

// Simulación de usuario autenticado (esto es solo para pruebas)
$_SESSION['usuario'] = "Josiaz";  // Simulación del usuario logueado

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión iniciada, redirigir al login
    header("Location: login.html");
    exit();
}

// Información simulada del usuario (para pruebas)
$usuario = [
    'nombre_usuario' => 'Josiaz Lopez',
    'correo' => 'Josiaz.@gmail.com',
    'fecha_creacion' => '28-Jun-2019',
    'genero' => 'Masculino'
];

// Información simulada del historial de compras y ventas (para pruebas)
$historial_compras = [
    ['marca' => 'Toyota', 'modelo' => 'Corolla', 'fecha_compra' => '10-Oct-2021'],
    ['marca' => 'Ford', 'modelo' => 'Mustang', 'fecha_compra' => '05-Mar-2022']
];

$historial_ventas = [
    ['marca' => 'Honda', 'modelo' => 'Civic', 'fecha_venta' => '15-Nov-2021']
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="perfil.css">
</head>
<body>
    <div class="perfil-container">
        <div class="perfil-header">
            <img src="ASSETS/usuario.png" alt="Foto de perfil" class="foto-perfil">
            <h2><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></h2>
        </div>

        <div class="perfil-info">
            <p><strong>Correo electrónico:</strong> <?php echo htmlspecialchars($usuario['correo']); ?></p>
            <p><strong>Fecha de creación:</strong> <?php echo htmlspecialchars($usuario['fecha_creacion']); ?></p>
            <p><strong>Género:</strong> <?php echo htmlspecialchars($usuario['genero']); ?></p>
        </div>

        <div class="perfil-historial">
            <h3>Historial de Compras</h3>
            <ul>
                <?php foreach ($historial_compras as $compra): ?>
                    <li><?php echo htmlspecialchars($compra['marca']) . " " . htmlspecialchars($compra['modelo']) . " - " . htmlspecialchars($compra['fecha_compra']); ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>Historial de Ventas</h3>
            <ul>
                <?php foreach ($historial_ventas as $venta): ?>
                    <li><?php echo htmlspecialchars($venta['marca']) . " " . htmlspecialchars($venta['modelo']) . " - " . htmlspecialchars($venta['fecha_venta']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="perfil-opciones">
            <a href="editar_perfil.php" class="boton-editar">Editar Perfil</a>
        </div>

        <div class="perfil-notificaciones">
            <p>¿Recibir notificaciones por correo electrónico?</p>
            <button>Sí</button> <button>No</button>
        </div>
    </div>
</body>
</html>
