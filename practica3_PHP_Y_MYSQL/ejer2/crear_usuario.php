<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <style>
        body {
            background-color: skyblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: skyblue;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crear Usuario</h1>
        <form action="guardar_usuario.php" method="POST">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Guardar Usuario</button>
        </form>
    </div>
</body>
</html>
