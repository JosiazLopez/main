<?php
session_start();

$carritoParaPago = $_SESSION['carrito_para_pago'];
$totalParaPago = $_SESSION['total_para_pago'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago</title>
    <link rel="stylesheet" href="form.css">
	<link rel="stylesheet" media="screen and (max-width: 400px)" href="estilos-mobile.css">
</head>
<body>
    <header>
        <h1>GANGA GAMES SM </h1>
    </header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li class="dropdown">
                <a href="#">Páginas</a>
                <ul class="submenu">
                    <li><a href="carrito.php">Carrito de Compras</a></li>
                    <li><a href="confirmacion.php">Confirmación de Compra</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <main>
        <section class="checkout-section">
            <div class="checkout-left">
                <h2>Confirmación de Pago</h2>
                <form action="confirmacion.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre en la Tarjeta:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="numero">Número de Tarjeta:</label>
                        <input type="text" id="numero" name="numero" required>
                    </div>
                    <div class="form-group">
                        <label for="vencimiento">Fecha de Vencimiento:</label>
                        <input type="text" id="vencimiento" name="vencimiento" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" required>
                    </div>
                    <button class="checkout-button" type="submit">Confirmar Pago</button>
                </form>
            </div>
            <div class="checkout-right">
                <h3>Resumen del Pedido</h3>
                <p>Productos:</p>
                <ul class="product-list">
                    <?php foreach ($carritoParaPago as $producto) : ?>
                        <li><?php echo $producto['nombre']; ?> - Q.<?php echo number_format($producto['precio'], 2); ?></li>
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
