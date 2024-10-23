<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importadora - Carros</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="ASSETS/logo.jpeg" alt="Logo de A&S Global Cars">
        </div>
        <h1>A&S Global Cars</h1>
        <nav>
            <ul class="navbar">
                <li><a href="#"><img src="ASSETS/carro.png" alt="Vehículos Icono"> Vehículos</a></li>
                <li><a href="#"><img src="ASSETS/ubicacion.png" alt="Ubicaciones Icono"> Ubicaciones</a></li>
                <li><a href="financiamiento.html"><img src="ASSETS/financiamiento.png" alt="Financiamiento Icono"> Financiamiento</a></li>
                <li><a href="#"><img src="ASSETS/subasta.png" alt="Subastas Icono"> Subastas online</a></li>
                <li><a href="oferta.html"><img src="ASSETS/compra.png" alt="Ofertas Icono"> Ofertas!</a></li>
                <li><a href="#"><img src="ASSETS/contact.png" alt="Contáctenos Icono"> Contáctenos</a></li>
                
                <!-- Mostrar el nombre de usuario si está conectado -->
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li><a href="perfil.php"><img src="ASSETS/usuario.png" alt="Usuario Icono"> Bienvenido, <?php echo $_SESSION['usuario']; ?></a></li>
                    <li><a href="logout.php"><img src="ASSETS/salida.png" alt="Cerrar sesión"> Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="login.html"><img src="ASSETS/exito.png" alt="Sesion Icono"> Registrarse/Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <center>
            <h2>Listado de Carros</h2>
        </center>
        <div class="car-list">
            <!-- PHP para mostrar carros dinámicamente desde la base de datos -->
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "root", "proyectosoftw");

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener todos los carros
            $query = "SELECT * FROM productos";
            $resultado = $conexion->query($query);

            // Si hay resultados, mostrar cada carro
            if ($resultado->num_rows > 0) {
                while ($carro = $resultado->fetch_assoc()) {
                    ?>
                    <div class="car-item">
                        <img src="<?php echo $carro['imagen']; ?>" alt="Imagen de <?php echo $carro['nombre']; ?>">
                        <h3><?php echo $carro['nombre']; ?></h3>
                        <p><?php echo $carro['descripcion']; ?></p>
                        <p>Precio: $<?php echo $carro['precio']; ?></p>
                        <!-- Botón para agregar al carrito -->
                        <a href="agregar_carrito.php?id=<?php echo $carro['id']; ?>&nombre=<?php echo $carro['nombre']; ?>&precio=<?php echo $carro['precio']; ?>" class="buy-button">Comprar</a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No hay carros disponibles.</p>";
            }

            // Cerrar la conexión
            $conexion->close();
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Importadora A&S Global Cars. Todos los derechos reservados.</p>
    </footer>
    <ul class="social-media">
        <li><a href="https://www.youtube.com/" target="_blank"><img src="ASSETS/youtube-icon.png" alt="YouTube Icon"></a></li>
        <li><a href="https://www.facebook.com/" target="_blank"><img src="ASSETS/facebook-icon.png" alt="Facebook Icon"></a></li>
        <li><a href="https://www.instagram.com/" target="_blank"><img src="ASSETS/instagram-icon.png" alt="Instagram Icon"></a></li>
        <li><a href="https://twitter.com/" target="_blank"><img src="ASSETS/Whatsapp.png" alt="Twitter Icon"></a></li>
    </ul>

    <script src="scripts.js"></script>
</body>
</html>
