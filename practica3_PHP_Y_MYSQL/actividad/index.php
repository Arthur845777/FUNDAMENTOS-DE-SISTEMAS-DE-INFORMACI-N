<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            color: blue;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Lista de Libros</h1>
    <table>
        <tr>
            <th>Nombre del Libro:</th>
            <th>Autor:</th>
            <th>ISBN :</th>
            <th>Descripción:</th>
            <th>Eliminar:</th>
            <th>Modificar:</th>
        </tr>

        <?php
        $sql = "SELECT * FROM libros";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre_libro"] . "</td>";
                echo "<td>" . $row["autor"] . "</td>";
                echo "<td>" . $row["isbn"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "<td><a href='eliminar.php?id=".$row['id']."'>Eliminar</a></td>";
                echo "<td><a href='modificar.php?id=".$row['id']."'>Editar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay datos disponibles</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
