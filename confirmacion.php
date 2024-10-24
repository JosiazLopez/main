<?php
session_start();

$carritoParaPago = $_SESSION['carrito_para_pago'];
$totalParaPago = $_SESSION['total_para_pago'];



// Verifica si los datos del formulario de confirmación fueron enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreEnTarjeta = $_POST['nombre'];
    $numeroDeTarjeta = $_POST['numero'];
    $vencimientoTarjeta = $_POST['vencimiento'];
    $cvvTarjeta = $_POST['cvv'];

    // Almacena los datos en la sesión
    $_SESSION['nombre_en_tarjeta'] = $nombreEnTarjeta;
    $_SESSION['numero_de_tarjeta'] = $numeroDeTarjeta;
    $_SESSION['vencimiento_tarjeta'] = $vencimientoTarjeta;
    $_SESSION['cvv_tarjeta'] = $cvvTarjeta;

    // Obtiene la fecha de compra
    $fechaDeCompra = date("Y-m-d");

    // Guarda la fecha de compra en la sesión
    $_SESSION['fecha_de_compra'] = $fechaDeCompra;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="estilos2.css">
	<link rel="stylesheet" media="screen and (max-width: 400px)" href="estilos-mobile.css">
    <script src="cookies.js" defer></script>
</head>
<body>
    <header>
        <div class="header-content">
            <img  src="logo.jpg" alt="GANGA GAMES SM Logo" class="logo">
            <h1>GANGA GAMES SM</h1>
			 <a href="index.php"><img src="carrito.png" class = "logo2"></a>
        </div>
    </header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="sobrenosotros.php">Sobre Nosotros</a></li>        
                    <li><a href="carrito.php">Carrito de Compras</a></li>
                   
                </ul>
            </li>
        </ul>
    </nav>
    <main>
        <section class="checkout-section">
            <div class="checkout-left">
                <h3>UBICACION DE LA COMPRA</h3>
    <button onclick="getLocation()">Obtener Ubicación</button>
    <p id="geo"></p>
    <script>
        var x = document.getElementById("geo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Tu navegador no es compatible con la geolocalización.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "LATITUD: " + position.coords.latitude + " LONGITUD: " + position.coords.longitude;
        }
    </script>
				<h2>Pago realizado con éxito<h2>
                <p>Nombre en la Tarjeta: <?php echo $nombreEnTarjeta; ?></p>
                <p>Últimos 2 dígitos de la Tarjeta: <?php echo substr($numeroDeTarjeta, -2); ?></p>
                <p>Fecha de Compra: <?php echo $fechaDeCompra; ?></p>
            </div>
            <div class="checkout-right">
                <h3>Resumen del Pedido</h3>
                <p>Productos:</p>
                <ul class="product-list">
                    <?php foreach ($carritoParaPago as $producto): ?>
                        <li><?php echo $producto['nombre'] . " - Q." . number_format($producto['precio'], 2); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p>Total:</p>
                <p class="price">Q.<?php echo number_format($totalParaPago, 2); ?></p>
            </div>
        </section>
    </main>
    <footer>
  <p>&copy; <?php echo date("Y"); ?> GANGA GAMES SM </p>
    </footer>
</body>
</html>