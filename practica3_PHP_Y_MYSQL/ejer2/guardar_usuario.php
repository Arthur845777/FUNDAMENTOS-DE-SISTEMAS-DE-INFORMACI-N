<?php
include 'conexion.php';

// Recoger los datos del formulario
$username = $_POST['username'];
$password = md5($_POST['password']); // Encriptar la contraseña con MD5

// Insertar el usuario en la base de datos
$sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario creado exitosamente.";
    echo "<a href='listar_usuarios.php'>Ver Usuarios</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
