<?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar la sesión del estudiante
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 2) {
    header("Location: login.php"); // Redirigir a la página de login si no hay sesión o el rol no es de estudiante
    exit();
}

// Obtener el ID del estudiante
$estudianteId = $_SESSION['user_id'];

// Consulta SQL para obtener las notas del estudiante
$sql = "SELECT asignaturas.nombre as asignatura, parcial, teoria, practica, notas.obs
        FROM notas
        INNER JOIN asignaturas ON notas.asignatura_id = asignaturas.id
        WHERE usuario_id = $estudianteId";

$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === false) {
    // Mostrar información detallada sobre el error
    echo "Error en la consulta: " . $conn->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_estudiante.css">
    <title>Visualizar Notas</title>
</head>
<body>
    <div class="content">
        <h2>Tus Notas</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Asignatura</th>
                        <th>Parcial</th>
                        <th>Teoría</th>
                        <th>Práctica</th>
                        <th>Observación</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['asignatura']}</td>
                        <td>{$row['parcial']}</td>
                        <td>{$row['teoria']}</td>
                        <td>{$row['practica']}</td>
                        <td>{$row['obs']}</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No hay notas registradas.";
        }
        ?>
    </div>
</body>
</html>
