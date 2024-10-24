<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="estilos.css">
	<link rel="stylesheet" media="screen and (max-width: 400px)" href="estilos-mobile.css">
    <script src="cookies.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="header-content">
            <img  src="logo.jpg" alt="GANGA GAMES SM Logo" class="logo">
            <h1>GANGA GAMES SM</h1>
			 <a href="carrito.php"><img src="carrito.png" class = "logo2"></a>
        </div>
    </header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>    
            <li><a href="sobrenosotros.php">Sobre Nosotros</a></li>
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
        <section>
            <center>
            <h2>Productos Destacados</h2>
			</center>
           <?php session_start();
$productos = array(
    array("nombre" => "Nintendo Switch", "imagen" => "producto1.jpg", "precio" => 1500.00, "descripcion" => "Descripción del Producto 1"),
    array("nombre" => "PlayStation 5", "imagen" => "producto2.jpg", "precio" => 1800.00, "descripcion" => "Descripción del Producto 2"),
    array("nombre" => "Xbox Series X", "imagen" => "producto3.jpg", "precio" => 1700.00, "descripcion" => "Descripción del Producto 3"),
    array("nombre" => "Nintendo Switch Lite", "imagen" => "producto4.jpg", "precio" => 1200.00, "descripcion" => "Descripción del Producto 4"),
    array("nombre" => "PlayStation 4", "imagen" => "producto5.jpg", "precio" => 1000.00, "descripcion" => "Descripción del Producto 5"),
    array("nombre" => "Xbox One", "imagen" => "producto6.jpg", "precio" => 900.00, "descripcion" => "Descripción del Producto 6"),
    array("nombre" => "Nintendo 3DS", "imagen" => "producto7.jpg", "precio" => 500.00, "descripcion" => "Descripción del Producto 7"),
    array("nombre" => "Nintendo Switch Pro Controller", "imagen" => "producto8.jpg", "precio" => 60.00, "descripcion" => "Descripción del Producto 8"),
    array("nombre" => "PlayStation DualShock 4", "imagen" => "producto9.jpg", "precio" => 50.00, "descripcion" => "Descripción del Producto 9"),
    array("nombre" => "Xbox Wireless Controller", "imagen" => "producto10.jpg", "precio" => 55.00, "descripcion" => "Descripción del Producto 10"),
    // Agregar más productos aquí
);
?>

  

    <main>
    <section>
        <div class="product-container">
            <?php 
            
                foreach ($productos as $index => $producto) {
                    echo '<div class="product" data-index="' . $index . '" draggable="true">';
                    echo '<img src="' . $producto["imagen"] . '" alt="' . $producto["nombre"] . '" class="product-image">';
                    echo '<h3>' . $producto["nombre"] . '</h3>';
                    echo '<p>Precio: Q.' . number_format($producto["precio"], 2) . '</p>';
                    echo '<button class="add-to-cart">Agregar al Carrito</button>';
                    echo '<a class="view-description" href="descripciones.php?id=' . urlencode($producto["nombre"]) . '">Ver Descripción</a>';
                    echo '</div>';
                }
                ?>
            
        </div>
    </section>
     <section>
            <div id="carrito" class="carrito">
                <a href="carrito.php"><img src="carrito.png" class="logo3"></a>
            </div>
        </section>
   </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const productos = document.querySelectorAll(".product");
            const carrito = document.getElementById("carrito");
            const productosArray = <?php echo json_encode($productos); ?>;

            productos.forEach((producto, index) => {
                producto.addEventListener("dragstart", e => {
                    const productoData = {
                        nombre: productosArray[index].nombre,
                        descripcion: productosArray[index].descripcion,
                        precio: productosArray[index].precio
                    };
                    e.dataTransfer.setData("text/plain", JSON.stringify(productoData));
                });

                const addToCartButton = producto.querySelector(".add-to-cart");
                addToCartButton.addEventListener("click", () => {
                    const productoData = productosArray[index];
                    addToCart(productoData);
                });
            });

            carrito.addEventListener("dragover", e => {
                e.preventDefault();
            });

            carrito.addEventListener("drop", e => {
                e.preventDefault();
                const productoData = JSON.parse(e.dataTransfer.getData("text/plain"));
                if (productoData) {
                    addToCart(productoData);
                }
            });

            function addToCart(producto) {
                fetch('actualizar_carrito.php', {
                    method: 'POST',
                    body: JSON.stringify({ producto }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        window.location.href = 'carrito.php';
                    }
                });
            }
        });
    </script>
    <div class="cookie-banner" id="cookieBanner">
        <p>Este sitio web utiliza cookies para mejorar la experiencia del usuario. Al usar este sitio, aceptas el uso de cookies.</p>
        <button class="accept-cookies" id="acceptCookies">Aceptar</button>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> GANGA GAMES SM </p>
    </footer>
</body>
</html>