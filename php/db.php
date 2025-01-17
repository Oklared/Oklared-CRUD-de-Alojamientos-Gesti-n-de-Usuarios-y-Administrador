<?php
$servername = "localhost";
$username = "root"; // Cambia si tienes otro usuario
$password = ""; // Cambia si tienes una contraseña configurada
$dbname = "mi_aplicacion";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
