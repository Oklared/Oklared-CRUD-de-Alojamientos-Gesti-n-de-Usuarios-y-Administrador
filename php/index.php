<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="registro.php" method="POST" id="registroForm">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>
        <br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>

        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="usuario">Usuario</option>
            <option value="administrativo">Administrativo</option>
        </select>
        <br>

        <button type="submit">Registrar</button>
        <br><br>

        <!-- Link para iniciar sesión -->
        <p>¿Ya tienes una cuenta? <a href="inicio_sesion.php">Inicia sesión aquí</a>.</p>

        <!-- Contenedor para los mensajes de error -->
        <div id="error-message" class="error-message" style="display: none;"></div>
    </form>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            let nombre = document.getElementById("nombre").value;
            let correo = document.getElementById("correo").value;
            let contrasena = document.getElementById("contrasena").value;
            let errorMessage = document.getElementById("error-message");

            if (!nombre || !correo || !contrasena) {
                errorMessage.textContent = "Por favor, completa todos los campos.";
                errorMessage.style.display = "block"; // Muestra el mensaje de error
                event.preventDefault(); // Evita el envío del formulario
            } else {
                errorMessage.style.display = "none"; // Oculta el mensaje de error si no hay errores
            }
        });
    </script>
</body>
</html>
