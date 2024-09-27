<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$host = 'localhost';
$user = 'root'; // Cambia esto si tienes un usuario diferente
$password = ''; // Cambia esto si tienes una contraseña
$dbname = 'the_imperial_db';

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]));
}

// Obtener datos del JSON recibido
$data = json_decode(file_get_contents('php://input'), true);
$nombre = $conn->real_escape_string($data['nombre']);
$correo = $conn->real_escape_string($data['correo']);
$tipo_habitacion = $conn->real_escape_string($data['tipo_habitacion']);
$fecha_checkin = $conn->real_escape_string($data['fecha_checkin']);
$fecha_checkout = $conn->real_escape_string($data['fecha_checkout']);

// Insertar en la base de datos
$sql = "INSERT INTO reservaciones (nombre, correo, tipo_habitacion, fecha_checkin, fecha_checkout) VALUES ('$nombre', '$correo', '$tipo_habitacion', '$fecha_checkin', '$fecha_checkout')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
