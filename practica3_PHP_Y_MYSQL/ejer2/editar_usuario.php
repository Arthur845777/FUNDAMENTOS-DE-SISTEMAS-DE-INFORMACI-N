<?php
include 'conexion.php';

$id = $_GET['id'];

// Consultar los datos del usuario
$sql = "SELECT * FROM usuarios WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="actualizar_usuario.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
            <input type="password" name="password" placeholder="Nueva Contraseña">
            <button type="submit">Actualizar Usuario</button>
        </form>
    </div>
</body>
</html>
