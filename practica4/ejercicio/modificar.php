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

    // Obtener los datos de la reserva
    $stmt = $conn->prepare("SELECT * FROM reservas WHERE id = ?");
    $stmt->bind_param("i", $id_reserva);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $reserva = $result->fetch_assoc();
    } else {
        echo "Reserva no encontrada.";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();
} else {
    echo "ID de reserva no proporcionado.";
    $conn->close();
    exit();
}

// Actualizar la reserva
if (isset($_POST['actualizar'])) {
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $noches = $_POST['noches'];
    $habitacion = $_POST['habitacion'];
    $huespedes = $_POST['huespedes'];

    $stmt_update = $conn->prepare("UPDATE reservas SET fechaingreso = ?, noches = ?, habitacion = ?, huespedes = ? WHERE id = ?");
    $stmt_update->bind_param("ssssi", $fecha_ingreso, $noches, $habitacion, $huespedes, $id_reserva);

    if ($stmt_update->execute()) {
        echo "Reserva actualizada con éxito.";
    } else {
        echo "Error al actualizar la reserva: " . $conn->error;
    }

    $stmt_update->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Reserva</title>
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
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="number"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modificar Reserva</h2>
        <form action="modificar.php?id=<?php echo urlencode($id_reserva); ?>" method="POST">
            <label for="fecha_ingreso">Fecha de Ingreso:</label>
            <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo htmlspecialchars($reserva['fechaingreso']); ?>" required>

            <label for="noches">Número de Noches:</label>
            <input type="number" id="noches" name="noches" value="<?php echo htmlspecialchars($reserva['noches']); ?>" required>

            <label for="habitacion">Habitación:</label>
            <input type="text" id="habitacion" name="habitacion" value="<?php echo htmlspecialchars($reserva['habitacion']); ?>" required>

            <label for="huespedes">Número de Huéspedes:</label>
            <input type="number" id="huespedes" name="huespedes" value="<?php echo htmlspecialchars($reserva['huespedes']); ?>" required>

            <button type="submit" name="actualizar">Actualizar Reserva</button>
        </form>
    </div>
</body>
</html>
