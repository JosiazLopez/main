<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción del Producto - GANGA GAMES SM</title>
    <link rel="stylesheet" href="descrip.css">
</head>
<body>
    <header>
        <h1>GANGA GAMES SM</h1>
    </header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li class="dropdown">
                <a href="#">Páginas</a>
                <ul class="submenu">
                    <li><a href="carrito.php">Carrito de Compras</a></li>
                    <li><a href="pagos.php">Confirmación de Compra</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <main>
        <section class="product-section">
            <div class="product-details">
                <img src="producto1.jpg" alt="Nintendo Switch" class="product-image">
                <h2>PLAY STATION</h2>
                <p class="price">Q.1500.00</p>
                <p>PLAY STATION</p>
                <p>Características:</p>
                <ul>
                    <li>Pantalla táctil de 6.2 pulgadas</li>
                    <li>Joy-Cons desmontables para modos multijugador</li>
                    <li>Compatible con una amplia variedad de juegos</li>
                    <li>Múltiples modos de juego, incluyendo TV, tabletop y portátil</li>
                </ul>
                <button class="add-to-cart">Agregar al Carrito</button>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> GANGA GAMES SM</p>
    </footer>
</body>
</html>