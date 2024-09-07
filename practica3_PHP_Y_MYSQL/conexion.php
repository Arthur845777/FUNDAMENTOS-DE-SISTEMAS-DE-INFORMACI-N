<?php
$servername = "localhost";
$username = "root";  // El nombre de usuario por defecto es root
$password = "";      // Deja el password vacío si estás usando XAMPP por defecto
$dbname = "libreria";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
