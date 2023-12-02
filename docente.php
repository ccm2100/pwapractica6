<?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar la sesión del docente
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
    header("Location: login.php"); // Redirigir a la página de login si no hay sesión o el rol no es de docente
    exit();
}

// Obtener el nombre del docente
$docenteId = $_SESSION['user_id']; // Asumiendo que 'user_id' es el identificador del usuario en la sesión
$sql = "SELECT nombre FROM usuarios WHERE id = $docenteId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $docenteNombre = $row['nombre'];
} else {
    // Manejo de error si no se encuentra el docente
    $docenteNombre = "Docente Desconocido";
}

// Consulta SQL para obtener las asignaturas
$sql = "SELECT * FROM asignaturas";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_docente.css">
    <title>Asignaturas</title>
</head>
<body>
    <header>
        <div class="header-content">
            <img src="logo.png" alt="Logo" class="logo">
            <h1>Bienvenido Docente <?php echo $docenteNombre; ?></h1>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="docente.php?section=visualizar-asignaturas">Visualizar Asignaturas</a></li>
            <!-- Otras opciones de navegación -->
            <li><a href="docente.php?section=ingresar-estudiantes">Ingresar Estudiantes</a></li>
            <li><a href="docente.php?section=asignar-materias">Asignar Materias a Estudiantes</a></li>
            <li><a href="docente.php?section=asignar-notas">Poner Notas</a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- Contenido de la página -->
        <?php
        // Mostrar el contenido según la lógica implementada
        if (isset($_GET['section'])) {
            $section = $_GET['section'];

            switch ($section) {
                case 'visualizar-asignaturas':
                    include('visualizar_asignaturas.php');
                    break;
                // Otras secciones...
                case 'ingresar-estudiantes':
                    include('ingresar_estudiantes.php');
                    break;
                case 'asignar-materias':
                    include('asignar_materias.php');
                    break;
                case 'asignar-notas':
                    include('asignar_notas.php');
                    break;    
                default:
                    echo "Sección no válida.";
                    break;
            }
        } else {
            echo "";
        }
        ?>
    </div>

    <?php

    ?>

</body>
</html>
