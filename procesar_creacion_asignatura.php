<?php
// Incluir el archivo de conexión
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $observaciones = $_POST['observaciones'];

    // Validar los datos si es necesario

    // Insertar la nueva asignatura en la base de datos
    $sqlInsert = "INSERT INTO asignaturas (nombre, obs) VALUES ('$nombre', '$observaciones')";
    if ($conn->query($sqlInsert) === TRUE) {
        // Redirigir después de la inserción exitosa
        header("Location: docente.php?section=visualizar-asignaturas");
        exit();
    } else {
        echo "Error al crear la asignatura: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
