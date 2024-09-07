<?php
include 'conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Usuario eliminado.";
    echo "<a href='listar_usuarios.php'>Ver Usuarios</a>";
} else {
    echo "Error eliminando el usuario: " . $conn->error;
}

$conn->close();
?>
