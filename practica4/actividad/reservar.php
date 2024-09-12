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

// Verificar si se seleccionó "Crear Usuario Nuevo"
if (isset($_POST['nuevo_usuario'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $celular = $_POST['celular'];

    // Insertar el nuevo usuario
    $sql_insert_user = "INSERT INTO usuarios (nombres, apellidos, dni, celular) VALUES ('$nombres', '$apellidos', '$dni', '$celular')";

    if ($conn->query($sql_insert_user) === TRUE) {
        echo "Nuevo usuario creado con éxito<br>";
        // Obtener el ID del usuario recién creado
        $id_usuario = $conn->insert_id;
    } else {
        echo "Error al crear el usuario: " . $conn->error;
    }
}

// Datos de la reserva
$fecha_ingreso = $_POST['fecha_ingreso'];
$noches = $_POST['noches'];
$habitacion = $_POST['habitacion'];
$huespedes = $_POST['huespedes'];

// Insertar la reserva en la tabla "reservas"
$sql_insert_reserva = "INSERT INTO reservas (fechaingreso, noches, habitacion, huespedes, usuario_id) VALUES ('$fecha_ingreso', '$noches', '$habitacion', '$huespedes', '$id_usuario')";

if ($conn->query($sql_insert_reserva) === TRUE) {
    echo "Reserva realizada con éxito<br>";
    echo "Datos de la reserva:<br>";
    echo "Fecha de ingreso: $fecha_ingreso<br>";
    echo "Número de noches: $noches<br>";
    echo "Habitación: $habitacion<br>";
    echo "Número de huéspedes: $huespedes<br>";
} else {
    echo "Error al realizar la reserva: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
