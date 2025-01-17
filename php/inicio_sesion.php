<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="validar_sesion.php" method="POST" id="loginForm">
        <h2>Inicio de Sesión</h2>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>
        <br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>

        <button type="submit">Iniciar Sesión</button>
        <br><br>

        <!-- Link para ir al formulario de registro -->
        <p>¿No tienes una cuenta? <a href="index.php">Regístrate aquí</a>.</p>

        <!-- Contenedor para mensajes de error -->
        <div id="login-error-message" class="error-message" style="display: none;"></div>
    </form>

    <script>
        document.querySelector("#loginForm").addEventListener("submit", function(event) {
            let correo = document.getElementById("correo").value;
            let contrasena = document.getElementById("contrasena").value;
            let errorMessage = document.getElementById("login-error-message");

            if (!correo || !contrasena) {
                errorMessage.textContent = "Por favor, completa todos los campos.";
                errorMessage.style.display = "block";
                event.preventDefault();
            } else {
                errorMessage.style.display = "none";
            }
        });
    </script>
</body>
</html>
