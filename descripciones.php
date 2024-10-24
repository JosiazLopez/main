<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción del Producto - GANGA GAMES SM</title>
    <link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" media="screen and (max-width: 400px)" href="estilos-mobile.css">
</head>
<body>
    <header>
        <div class="header-content">
            <img src="logo.jpg" alt="GANGA GAMES SM Logo" class="logo">
            <h1>GANGA GAMES SM</h1>
            <a href="carrito.php"><img src="carrito.png" class="logo3"></a>
        </div>
    </header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>
          
            <li><a href="sobrenosotros.php">Sobre Nosotros</a></li>
            <li class="search-icon"><a href="#"><img src="lupa.png" alt="Buscar" class="search-icon-img">Buscar</a></li>
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
        <section class="product-description-section">
            <?php
            // Recibe el parámetro id de la URL
            $productoId = $_GET['id'];

            // Aquí podrías tener un array asociativo con las descripciones de los productos
            // Por ejemplo:
            $productos = array(
                "Nintendo Switch" => array(           
					"descripcion" => "Disfruta de una experiencia de consola doméstica incluso sin televisor.
Nintendo Switch se transforma para adaptarse a tu situación y te permite jugar a los títulos que quieras aunque no tengas mucho tiempo.

Es una nueva era en la que no tienes que adaptar tu vida a los videojuegos: ahora es la consola la que se adapta a tu vida.

¡Disfruta de tus juegos cuando quieras, donde quieras y como quieras!",
                    "imagen" => "producto1.jpg"
                ),
                "PlayStation 5" => array(
                    "descripcion" => "La PlayStation 5 es la última generación de consolas de Sony...",
                    "imagen" => "producto2.jpg"
                ),
				 "Xbox Series X" => array(
                    "descripcion" => "Se trata de la Xbox más rápida y potente de la historia, ya que logra alcanzar la soñada resolución 4K (con posibilidad de HDR 8K), ray tracing y hasta 120 fps. Además, gracias a su almacenamiento SSD, la descarga de juegos y contenido es sumamente más rápida que en la pasada generación.",
                    "imagen" => "producto3.jpg"
                ),
				 "Nintendo Switch Lite" => array(
                    "descripcion" => "Nintendo Switch Lite, la nueva incorporación a la familia Nintendo Switch, es una consola compacta, ligera y fácil de transportar, que cuenta con controles integrados. Con Nintendo Switch Lite se puede jugar a todos los programas de Nintendo Switch que son compatibles con el modo portátil.",
                    "imagen" => "producto4.jpg"
                ),
				 "PlayStation 4" => array(
                    "descripcion" => "La PlayStation 4 o PS4 es la cuarta consola de Sony, lanzada en 2013. La PS4 de Sony está disponible en tres versiones; la PlayStation 4, la PlayStation 4 Slim y la PlayStation 4 Pro. Los juegos de PS4 se pueden comprar directamente en la tienda oficial PlayStation Store",
                    "imagen" => "producto5.jpg"
                ), "Xbox One" => array(
                    "descripcion" => "La consola está formada por un procesador AMD de 8 núcleos Custom de 64 bits basado en microarquitectura Jaguar y una velocidad estimada en 1,75 Ghz, 8 GB de memoria RAM DDR3 más 32 MB de ESRAM, con una velocidad de hasta 204 GB/s​ 500 GB de disco duro y un lector Blu-ray 6x.",
                    "imagen" => "producto6.jpg"
                ), "Nintendo 3DS" => array(
                    "descripcion" => "La familia de consolas Nintendo 3DS son las consolas portátiles de Nintendo más recientes, que ofrecen una variedad de programas y funciones únicas en un formato compacto. Nintendo 3DS está disponible en varios colores, por lo que hay modelos para todos los gustos.",
                    "imagen" => "producto7.jpg"
                ),
				"Nintendo Switch Pro Controller" => array(
                    "descripcion" => "El Control inalámbrico Pro para la Nintendo Switch te ayudara a mejorar tu experiencia de juego gracias a su diseño que incluye controles de movimiento, dos palancas de control analógicas, la capacidad de leer figuras Amiibo, y un cable USB-C para la carga.",
                    "imagen" => "producto8.jpg"
                ),
				"PlayStation DualShock 4" => array(
                    "descripcion" => "El DUALSHOCK 4 fue creado en conjunto con otro periférico, una cámara, que puede medir la proundidad del ambiente, y además la locación en 3D de los controles a través de la barra de LEDs. La nueva cámara incorpora cuatro micrófonos capaces de detectar el sonido de una manera exacta, para una precisión jamás vista.",
                    "imagen" => "producto9.jpg"
                ),
				"Xbox Wireless Controller" => array(
                    "descripcion" => "Superficies moldeadas y geometría refinada para mayor comodidad y control sin esfuerzo durante el juego. Rendimiento de la batería de hasta 40 horas. Conecta cualquier auricular compatible con el enchufe de audio de 3.5 milímetros..",
                    "imagen" => "producto10.jpg"
                ),
                // ... Agregar más descripciones y rutas de imágenes aquí
            );

            // Verifica si existe la descripción del producto en el array
            if (array_key_exists($productoId, $productos)) {
                $producto = $productos[$productoId];
                echo '<div class="product-description">';
                echo '<h2>' . $productoId . '</h2>';
                echo '<img src="' . $producto["imagen"] . '" alt="' . $productoId . '" class="product-description-image">';
                echo '<p>' . $producto["descripcion"] . '</p>';
				echo '<button class="add-to-cart">Añadir al Carrito</button>';
                echo '<a href="index.php" class="return-button">Regresar</a>';
                echo '</div>';
            } else {
                echo '<p>Producto no encontrado.</p>';
            }
            ?>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> GANGA GAMES SM </p>
    </footer>
</body>
</html>
