<?php
session_start(); // Iniciar la sesión al principio del script

// Incluir el archivo de conexión
include('conexion.php');

// Obtener datos del formulario
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$rol = $_POST['rol'];

// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM usuarios WHERE email='$email' AND contrasena='$contrasena' AND rol='$rol'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario autenticado correctamente
    $row = $result->fetch_assoc();

    // Establecer variables de sesión
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['rol'] = $row['rol'];

    // Redirigir según el rol
    if ($rol == 1) {
        header("Location: docente.php");
    } elseif ($rol == 2) {
        header("Location: estudiante.php");
    }
} else {
    // Mostrar mensaje de error o redirigir a la página de login con un mensaje de error
    header("Location: login.php?error=1");
}

$conn->close();
?>
