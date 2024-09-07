<?php
include 'conexion.php';

// Consultar los usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

echo "<h1>Lista de Usuarios</h1>";
echo "<a href='crear_usuario.php'>Crear Nuevo Usuario</a><br><br>";

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Acciones</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['username'] . "</td>
                <td>
                    <a href='editar_usuario.php?id=" . $row['id'] . "'>Editar</a> | 
                    <a href='eliminar_usuario.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Seguro que quieres eliminar este usuario?')\">Eliminar</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No hay usuarios.";
}

$conn->close();
?>
