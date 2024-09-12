<?php
// Establecer la codificación
header('Content-Type: text/html; charset=utf-8');

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel"; // Cambia por el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el ID de la reserva
if (isset($_GET['id'])) {
    $id_reserva = $_GET['id'];

    // Eliminar la reserva
    $stmt = $conn->prepare("DELETE FROM reservas WHERE id = ?");
    $stmt->bind_param("i", $id_reserva);

    if ($stmt->execute()) {
        $mensaje = "Reserva cancelada.";
    } else {
        $mensaje = "Error al eliminar la reserva: " . $conn->error;
    }

    $stmt->close();
} else {
    $mensaje = "ID de reserva no proporcionado.";
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            text-align: center;
        }
        .message {
            font-size: 18px;
            color: #5bc0de;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px;
            background-color: #5bc0de;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #31b0d5;
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
        <a href="reservar.php">Volver a la página principal</a>
    </div>
</body>
</html>
