<?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar la sesión del estudiante
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 2) {
    header("Location: login.php"); // Redirigir a la página de login si no hay sesión o el rol no es de estudiante
    exit();
}

// Obtener el nombre del estudiante
$estudianteId = $_SESSION['user_id']; // Asumiendo que 'user_id' es el identificador del usuario en la sesión
$sql = "SELECT nombre FROM usuarios WHERE id = $estudianteId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $estudianteNombre = $row['nombre'];
} else {
    // Manejo de error si no se encuentra el estudiante
    $estudianteNombre = "Estudiante Desconocido";
}

// Consulta SQL para obtener las notas del estudiante
$sqlNotas = "SELECT asignaturas.nombre as asignatura, parcial, teoria, practica, obs
             FROM notas
             INNER JOIN asignaturas ON notas.asignatura_id = asignaturas.id
             WHERE usuario_id = $estudianteId";
$resultNotas = $conn->query($sqlNotas);

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
    <header>
        <div class="header-content">
            <h1>Bienvenido Estudiante <?php echo $estudianteNombre; ?></h1>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="estudiante.php?section=visualizar-notas">Visualizar Notas</a></li>
            <!-- Otras opciones de navegación -->
        </ul>
    </nav>

    <div class="content">
        <!-- Contenido de la página -->
        <?php
        // Mostrar el contenido según la lógica implementada
        if (isset($_GET['section'])) {
            $section = $_GET['section'];

            switch ($section) {
                case 'visualizar-notas':
                    include('visualizar_notas_est.php');
                    break;
                // Otras secciones...
                default:
                    echo "Sección no válida.";
                    break;
            }
        } else {
            echo "";
        }
        ?>
    </div>

</body>
</html>
