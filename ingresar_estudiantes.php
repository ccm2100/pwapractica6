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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_docente.css">
    <link rel="stylesheet" href="css/styles_ingresar_estudiantes.css">
    <title>Ingresar Estudiantes</title>
</head>
<body>

<!-- Contenedor principal -->
<div class="contenedor-principal">

    <!-- Sección izquierda: Formulario de creación -->
    <div class="seccion-izquierda">
        <h2>Ingresar Estudiante</h2>

        <!-- Mensaje de éxito o error -->
        <div id="mensaje">
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
            } elseif (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']); // Limpiar el mensaje de error después de mostrarlo
            }
            ?>
        </div>

        <form method="post" action="procesar_creacion_estudiante.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="observacion">Observación:</label>
            <textarea id="observacion" name="observacion" rows="4"></textarea>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <div style="text-align: center; margin-top: 10px;">
                <input type="submit" name="submit" class="btn-guardar" value="Guardar">
            </div>
        </form>
    </div>

    <!-- Sección derecha: Tabla de estudiantes -->
    <div class="seccion-derecha">
        <h2>Lista de Estudiantes</h2>
        <?php
        // Consulta SQL para obtener solo los registros de estudiantes (rol 2)
        $sqlEstudiantes = "SELECT * FROM usuarios WHERE rol = 2";
        $resultEstudiantes = $conn->query($sqlEstudiantes);

        if ($resultEstudiantes->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                    </tr>";

            while ($row = $resultEstudiantes->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['rol']}</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No hay estudiantes registrados.";
        }
        ?>
    </div>

</div>

</body>
</html>
