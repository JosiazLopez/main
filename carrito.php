

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - GANGA GAMES SM</title>
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
        <div class="cart-container">
            <h2>Carrito de Compras</h2>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					session_start();
					
                    $total = 0;
                    if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'];

							echo '<tr>';
                            
                            echo '</tr>';
                            $total += $producto['precio'];
                        }
						
                    }
$_SESSION['total_para_pago'] = $total;
                    ?>
                </tbody>
		
			<tbody> 
    <?php
    $total = 0;
    if (isset($_SESSION['carrito'])) {
   foreach ($_SESSION['carrito'] as $index => $producto){
       
            echo '<tr>';
            echo '<td>' . $producto['nombre'] . '</td>';
            echo '<td>Q.' . number_format($producto['precio'], 2) . '</td>';
            echo '<td><button class="remove-button" onclick="removeFromCart(' . $index . ')">Eliminar</button></td>';
          echo '<td><a href="actualizar_carrito.php" onclick="addAnotherToCart(' . $index . ')">Agregar otro</a></td>';


		   echo '</tr>';
            $total += $producto['precio'];
        }
		$_SESSION['carrito_para_pago'] = $_SESSION['carrito'];
$_SESSION['total_para_pago'] = $total;
    }
    ?>
</tbody> 
            </table>
            <p>Total a Pagar: Q.<?php echo number_format($total, 2); ?></p>
            <a href="pagos.php" class="continue-button">Continuar con la Compra</a>
			
        </div>
    </section>
</main>
    <footer>
    <p>&copy; <?php echo date("Y"); ?> GANGA GAMES SM </p>
    </footer>

     <script>
	  function addAnotherToCart(index) {
        fetch('actualizar_carrito.php?action=add&index=' + index)
            .then(response => {
                if (response.ok) {
                    window.location.reload(); // Recargar la página después de agregar otro producto
                }
            });
    }
        function increaseQuantity(index) {
            location.href = 'actualizar_carrito.php?action=increase&index=' + index;
        }

        function decreaseQuantity(index) {
            location.href = 'actualizar_carrito.php?action=decrease&index=' + index;
        }

        function removeFromCart(index) {
            location.href = 'actualizar_carrito.php?action=remove&index=' + index;
        }
		document.addEventListener("DOMContentLoaded", function() {
            const carrito = document.getElementById("carrito");
            const cartItemsContainer = document.getElementById("cart-items");

            carrito.addEventListener("dragover", e => {
                e.preventDefault();
            });

            carrito.addEventListener("drop", e => {
                e.preventDefault();
                const productoData = JSON.parse(e.dataTransfer.getData("text/plain"));
                if (productoData) {
                    const cartItem = document.createElement("tr");
                    cartItem.innerHTML = `
                        <td>${productoData.nombre}</td>
                        <td>Q. ${productoData.precio.toFixed(2)}</td>
                    `;
                    cartItemsContainer.appendChild(cartItem);
					
                }
            });
        });
    </script>
</body>
</html>
