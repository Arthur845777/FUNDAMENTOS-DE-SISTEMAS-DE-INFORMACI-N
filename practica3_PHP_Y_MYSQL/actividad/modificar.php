<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado un formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del libro desde la URL
    $id = $_GET['id'];
    // Obtener los valores del formulario
    $nombre_libro = $_POST['nombre_libro'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $descripcion = $_POST['descripcion'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE libros SET nombre_libro='$nombre_libro', autor='$autor', isbn='$isbn', descripcion='$descripcion' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Libro actualizado con éxito";
    } else {
        echo "Error al actualizar el libro: " . $conn->error;
    }

    // Redirigir de vuelta a la lista de libros
    header("Location: index.php");
    exit();
}

// Verificar si se ha pasado un ID de libro para editar
if (isset($_GET['id'])) {
    // Obtener el ID del libro desde la URL
    $id = $_GET['id'];
    // Seleccionar los datos del libro de la base de datos
    $sql = "SELECT * FROM libros WHERE id=$id";
    $result = $conn->query($sql);

    // Si se encuentra el libro, mostrar el formulario con sus datos
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontró el libro con ID $id";
        exit();
    }
} else {
    echo "ID de libro no proporcionado";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Libro</title>
</head>
<body>
    <h1>Modificar Libro</h1>
    <!-- Formulario de edición -->
    <form action="modificar.php?id=<?php echo $id; ?>" method="POST">
        <label for="nombre_libro">Nombre del Libro:</label><br>
        <input type="text" name="nombre_libro" value="<?php echo $row['nombre_libro']; ?>"><br><br>

        <label for="autor">Autor:</label><br>
        <input type="text" name="autor" value="<?php echo $row['autor']; ?>"><br><br>

        <label for="isbn">ISBN:</label><br>
        <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion"><?php echo $row['descripcion']; ?></textarea><br><br>

        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
