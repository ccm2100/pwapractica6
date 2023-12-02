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

// Lógica para manejar la asignación de materias si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Obtener datos del formulario
        $usuario_id = $_POST['usuario_id'];
        $asignatura_id = $_POST['asignatura_id'];
        $lugar_id = $_POST['lugar_id'];

        // Insertar la asignación en la tabla asignaturas_estudiante
        $sqlInsertAsignatura = "INSERT INTO asignaturas_estudiante (usuario_id, asignatura_id, lugar_id) VALUES ($usuario_id, $asignatura_id, $lugar_id)";
        if ($conn->query($sqlInsertAsignatura) === TRUE) {
            // Mensaje de éxito almacenado en una variable de sesión
            $_SESSION['mensaje'] = "Asignación exitosa";
        } else {
            // Mensaje de error almacenado en una variable de sesión
            $_SESSION['error'] = "Error al asignar la materia: " . $conn->error;
        }

        // Redirigir a la página anterior
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
}

// En caso de acceso directo sin enviar el formulario, redirigir a la página anterior
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>
