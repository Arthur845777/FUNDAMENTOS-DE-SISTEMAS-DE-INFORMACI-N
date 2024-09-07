<?php
include 'conexion.php';

$id = $_POST['id'];
$username = $_POST['username'];
$password = !empty($_POST['password']) ? md5($_POST['password']) : null; // Solo actualizar la contraseña si se ha introducido

if ($password) {
    $sql = "UPDATE usuarios SET username='$username', password='$password' WHERE id=$id";
} else {
    $sql = "UPDATE usuarios SET username='$username' WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    echo "Usuario actualizado exitosamente.";
    echo "<a href='listar_usuarios.php'>Ver Usuarios</a>";
} else {
    echo "Error actualizando el usuario: " . $conn->error;
}

$conn->close();
?>
