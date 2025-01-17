<?php
session_start();
include 'db.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$usuario_nombre = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : 'Usuario';
$usuario_rol = isset($_SESSION['usuario_rol']) ? $_SESSION['usuario_rol'] : 'Usuario';

// Función para obtener todos los usuarios (solo para el administrador)
function obtenerUsuarios($conn) {
    $sql = "SELECT id, nombre, correo, rol FROM usuarios WHERE rol != 'administrativo'";
    $resultado = $conn->query($sql);
    if (!$resultado) {
        die("Error al obtener usuarios: " . $conn->error);
    }
    return $resultado;
}

// Manejar solicitudes de eliminar usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar_usuario']) && $usuario_rol === 'administrativo') {
        $usuario_a_eliminar = $_POST['usuario_id'];
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario_a_eliminar);

        if ($stmt->execute()) {
            header("Location: principal.php");
            exit();
        } else {
            die("Error al eliminar usuario: " . $stmt->error);
        }
    }
}

// Obtener usuarios si el rol es administrativo
$usuarios = null;
if ($usuario_rol === 'administrativo') {
    $usuarios = obtenerUsuarios($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
        }
        h1, h2 {
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
        }
        .btn {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($usuario_nombre); ?>!</h1>
    <h2>Rol: <?php echo htmlspecialchars($usuario_rol); ?></h2>

    <div class="container">
        <?php if ($usuario_rol === 'administrativo'): ?>
            <h3>Administración de Usuarios</h3>
            <?php if ($usuarios && $usuarios->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($usuario = $usuarios->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $usuario['id']; ?></td>
                                <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                                        <button type="submit" name="eliminar_usuario" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay usuarios disponibles.</p>
            <?php endif; ?>
        <?php else: ?>
            <h3>No tienes acceso a esta sección.</h3>
        <?php endif; ?>

        <!-- Enlace para regresar al formulario de registro -->
        <p><a href="registro.php">Regresar al registro</a></p>
    </div>
</body>
</html>
