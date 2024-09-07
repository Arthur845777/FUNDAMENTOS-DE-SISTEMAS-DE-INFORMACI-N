<?php
// Incluir el archivo de conexión
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);  // Encriptar la contraseña con MD5

    // Consulta para verificar el usuario y la contraseña
    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Inicio de sesión exitoso";
        // Aquí podrías redirigir al usuario a otra página
        // header("Location: dashboard.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}

// Cerrar la conexión
$conn->close();
?>
