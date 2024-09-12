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

// Preparar declaraciones para evitar inyecciones SQL
$stmt_user = $conn->prepare("INSERT INTO usuarios (nombres, apellidos, dni, celular) VALUES (?, ?, ?, ?)");
$stmt_reserva = $conn->prepare("INSERT INTO reservas (fechaingreso, noches, habitacion, huespedes, usuario_id) VALUES (?, ?, ?, ?, ?)");

// Inicializar la variable de ID de usuario
$id_usuario = null;

// Verificar si se seleccionó "Crear Usuario Nuevo"
if (isset($_POST['nuevo_usuario'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $celular = $_POST['celular'];

    // Insertar el nuevo usuario
    $stmt_user->bind_param("ssss", $nombres, $apellidos, $dni, $celular);
    if ($stmt_user->execute()) {
        $id_usuario = $conn->insert_id;
    } else {
        echo "Error al crear el usuario: " . $conn->error;
        $stmt_user->close();
        $conn->close();
        exit();
    }

    // Datos de la reserva
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $noches = $_POST['noches'];
    $habitacion = $_POST['habitacion'];
    $huespedes = $_POST['huespedes'];

    // Insertar la reserva en la tabla "reservas"
    $stmt_reserva->bind_param("ssssi", $fecha_ingreso, $noches, $habitacion, $huespedes, $id_usuario);
    if ($stmt_reserva->execute()) {
        echo "Reserva realizada con éxito<br>";
        echo "Datos de la reserva:<br>";
        echo "Fecha de ingreso: $fecha_ingreso<br>";
        echo "Número de noches: $noches<br>";
        echo "Habitación: $habitacion<br>";
        echo "Número de huéspedes: $huespedes<br>";

        // Mostrar la tabla con la información del cliente y reservas
        echo "<h2>Información del Cliente y Reservas</h2>";

        // Mostrar datos del cliente
        $result = $conn->query("SELECT * FROM usuarios WHERE id = $id_usuario");
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            echo "<h3>Cliente</h3>";
            echo "<p><strong>Nombres:</strong> " . htmlspecialchars($usuario['nombres']) . "<br>";
            echo "<strong>Apellidos:</strong> " . htmlspecialchars($usuario['apellidos']) . "<br>";
            echo "<strong>DNI:</strong> " . htmlspecialchars($usuario['dni']) . "<br>";
            echo "<strong>Celular:</strong> " . htmlspecialchars($usuario['celular']) . "</p>";

            // Mostrar reservas
            $result_reservas = $conn->query("SELECT * FROM reservas WHERE usuario_id = $id_usuario");

            if ($result_reservas->num_rows > 0) {
                echo "<table border='1' cellpadding='5' cellspacing='0'>";
                echo "<tr><th>ID Reserva</th><th>Fecha de Ingreso</th><th>Número de Noches</th><th>Habitación</th><th>Huéspedes</th><th>Acciones</th></tr>";

                while ($reserva = $result_reservas->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($reserva['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($reserva['fechaingreso']) . "</td>";
                    echo "<td>" . htmlspecialchars($reserva['noches']) . "</td>";
                    echo "<td>" . htmlspecialchars($reserva['habitacion']) . "</td>";
                    echo "<td>" . htmlspecialchars($reserva['huespedes']) . "</td>";
                    echo "<td>";
                    echo "<a href='modificar.php?id=" . urlencode($reserva['id']) . "'>Modificar</a> | ";
                    echo "<a href='eliminar.php?id=" . urlencode($reserva['id']) . "'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No hay reservas para este cliente.";
            }
        } else {
            echo "No se encontró el cliente.";
        }
    } else {
        echo "Error al realizar la reserva: " . $conn->error;
    }

    // Cerrar las declaraciones
    $stmt_user->close();
    $stmt_reserva->close();
}

// Cerrar la conexión
$conn->close();
?>
