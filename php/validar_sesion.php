<?php
session_start();
include 'db.php'; // Asegúrate de tener tu archivo de conexión a la base de datos

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consultar si el usuario existe en la base de datos
    $sql = "SELECT id, nombre, correo, contrasena, rol FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar si la contraseña es correcta
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // Iniciar sesión y almacenar los datos del usuario
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_rol'] = $usuario['rol'];

            // Redirigir al usuario a la página principal
            header("Location: principal.php");
            exit();
        } else {
            $error_message = "La contraseña es incorrecta.";
        }
    } else {
        $error_message = "El correo electrónico no está registrado.";
    }
}
?>

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
        
        <?php if (isset($error_message)): ?>
            <div class="error-message" style="color: red;"><?= $error_message ?></div>
        <?php endif; ?>

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
