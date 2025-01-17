<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

if (isset($_POST['alojamientos'])) {
    $alojamientos = $_POST['alojamientos'];

    // Eliminar alojamientos previos del usuario
    $sql = "DELETE FROM usuario_alojamientos WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    // Guardar nuevos alojamientos seleccionados
    foreach ($alojamientos as $alojamiento_id) {
        $sql = "INSERT INTO usuario_alojamientos (usuario_id, alojamiento_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $usuario_id, $alojamiento_id);
        $stmt->execute();
    }

    echo "Alojamientos guardados correctamente.";
    // Redirigir a la página de cuenta
    header("Location: cuenta_usuario.php");
}

$stmt->close();
$conn->close();
?>
