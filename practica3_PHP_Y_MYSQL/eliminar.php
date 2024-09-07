<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL para eliminar el libro
    $sql = "DELETE FROM libros WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Libro eliminado con éxito";
    } else {
        echo "Error al eliminar el libro: " . $conn->error;
    }

    // Redirigir de vuelta a la lista de libros
    header("Location: index.php");
}

$conn->close();
?>
