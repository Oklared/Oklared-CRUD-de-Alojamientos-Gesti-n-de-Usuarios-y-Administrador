<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Iniciar sesión</h1>
        <form action="autenticar.php" method="POST">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>

