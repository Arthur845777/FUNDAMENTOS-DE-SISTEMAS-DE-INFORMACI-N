<?php
// Conexión a la base de datos MySQL en XAMPP
$conn = new mysqli('localhost', 'root', '', 'usuarios_db');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
