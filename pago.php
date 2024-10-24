<?php
session_start(); // Asegúrate de iniciar la sesión al principio

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está logueado
    header("Location: login.html");
    exit();
}

// Obtener el total desde la URL (GET), y asegurar que es un valor numérico válido
$total = isset($_GET['total']) ? floatval($_GET['total']) : 0;

// Verificación de que el total es mayor que cero
if ($total <= 0) {
    die("Error: El total debe ser mayor que cero. Valor recibido: " . htmlspecialchars($total));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pago</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="ASSETS/logo.jpeg" alt="Logo de A&S Global Cars">
        </div>
        <h1>J&S Global Cars</h1>
    </header>
    <main>
        <center>
            <h2>Datos de Pago</h2>
            <!-- Mostramos el total a pagar formateado -->
            <p>Total a Pagar: $<?php echo number_format($total, 2); ?></p>
        </center>
        
        <!-- Formulario para el pago -->
        <form action="confirmacion.php" method="post" class="payment-form">
            <!-- Enviar el total como campo oculto -->
            <input type="hidden" name="total" value="<?php echo htmlspecialchars($total); ?>">
            
            <!-- Campos de pago -->
            <label for="nombre">Nombre en la Tarjeta:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="tarjeta">Número de Tarjeta:</label>
            <input type="text" id="tarjeta" name="tarjeta" required>
            
            <label for="expiracion">Fecha de Expiración (MM/AA):</label>
            <input type="text" id="expiracion" name="expiracion" required pattern="\d{2}/\d{2}" title="Formato: MM/AA">
            
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required pattern="\d{3}" title="Debe ser un número de 3 dígitos">
            
            <label for="metodo">Método de Pago:</label>
            <select id="metodo" name="metodo" required>
                <option value="">Seleccione un método de pago</option>
                <option value="Tarjeta de Crédito/Débito">Tarjeta de Crédito/Débito</option>
                <option value="PayPal">PayPal</option>
            </select>

            <!-- Botón para confirmar el pago -->
            <button type="submit">Confirmar Pago</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Importadora A&S Global Cars. Todos los derechos reservados.</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
