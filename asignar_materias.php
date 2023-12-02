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

        // Redirigir a la página actual para mostrar la tabla de asignaciones actualizada
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}

// Consulta SQL para obtener la lista de estudiantes
$resultEstudiantes = $conn->query("SELECT * FROM usuarios WHERE rol = 2");

// Consulta SQL para obtener la lista de asignaturas
$resultAsignaturas = $conn->query("SELECT * FROM asignaturas");

// Consulta SQL para obtener la lista de lugares
$resultLugares = $conn->query("SELECT * FROM lugares");

// Consulta SQL para obtener la lista de asignaciones
$resultAsignaciones = $conn->query("SELECT ae.id, u.nombre as estudiante, a.nombre as asignatura, l.nombre as lugar
                                    FROM asignaturas_estudiante ae
                                    INNER JOIN usuarios u ON ae.usuario_id = u.id
                                    INNER JOIN asignaturas a ON ae.asignatura_id = a.id
                                    INNER JOIN lugares l ON ae.lugar_id = l.id");
?>

<!-- Sección izquierda: Formulario de asignación de materias -->
<div class="seccion-izquierda">
    <h2>Asignar Materias</h2>

    <!-- Mensaje de éxito o error -->
    <div id="mensaje"><?php echo isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : (isset($_SESSION['error']) ? $_SESSION['error'] : ''); ?></div>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="usuario_id">Estudiante:</label>
        <select id="usuario_id" name="usuario_id" required>
            <?php
            while ($row = $resultEstudiantes->fetch_assoc()) {
                echo "<option value=\"{$row['id']}\">{$row['nombre']}</option>";
            }
            ?>
        </select>

        <label for="asignatura_id">Asignatura:</label>
        <select id="asignatura_id" name="asignatura_id" required>
            <?php
            while ($row = $resultAsignaturas->fetch_assoc()) {
                echo "<option value=\"{$row['id']}\">{$row['nombre']}</option>";
            }
            ?>
        </select>

        <label for="lugar_id">Lugar:</label>
        <select id="lugar_id" name="lugar_id" required>
            <?php
            while ($row = $resultLugares->fetch_assoc()) {
                echo "<option value=\"{$row['id']}\">{$row['nombre']}</option>";
            }
            ?>
        </select>

        <div style="text-align: center; margin-top: 10px;">
            <input type="submit" name="submit" class="btn-guardar" value="Asignar">
        </div>
    </form>
</div>

<!-- Sección derecha: Tabla de asignaciones -->
<div class="seccion-derecha">
    <h2>Lista de Asignaciones</h2>
    <?php
    if ($resultAsignaciones->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>Asignatura</th>
                    <th>Lugar</th>
                </tr>";

        while ($row = $resultAsignaciones->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['estudiante']}</td>
                    <td>{$row['asignatura']}</td>
                    <td>{$row['lugar']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No hay asignaciones registradas.";
    }
    ?>
</div>

<?php
// Limpiar mensajes después de mostrarlos
unset($_SESSION['mensaje']);
unset($_SESSION['error']);
?>
