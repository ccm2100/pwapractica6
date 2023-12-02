<?php

// Verificar si la sesión está activa antes de iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar la sesión del docente
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
    header("Location: login.php");
    exit();
}

// Incluir el archivo de conexión
include('conexion.php');

// Lógica para manejar el ingreso de estudiantes si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Obtener datos del formulario
        $nombre = $_POST['nombre'];
        $observacion = $_POST['observacion'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];

        // Definir el rol para el estudiante (en este caso, 2 para estudiantes)
        $rolEstudiante = 2;

        // Insertar el nuevo usuario en la tabla usuarios
        $sqlInsertUsuario = "INSERT INTO usuarios (nombre, email, rol, contrasena, obs) VALUES ('$nombre', '$email', $rolEstudiante, '$contrasena', '$observacion')";
        if ($conn->query($sqlInsertUsuario) === TRUE) {
            // Mensaje de éxito almacenado en una variable de sesión
            $_SESSION['mensaje'] = "Registro exitoso";
            header("Location: docente.php?section=ingresar-estudiantes");
            exit();
        } else {
            // Mensaje de error almacenado en una variable de sesión
            $_SESSION['error'] = "Error al ingresar el estudiante: " . $conn->error;
        }
    }
}

// Limpiar mensajes después de mostrarlos
unset($_SESSION['mensaje']);
unset($_SESSION['error']);

?>
