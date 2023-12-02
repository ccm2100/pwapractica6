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

// Lógica para manejar la asignación de notas si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Obtener datos del formulario
        $usuario_id = $_POST['usuario_id'];
        $asignatura_id = $_POST['asignatura_id'];
        $parcial = $_POST['parcial'];
        $teoria = $_POST['teoria'];
        $practica = $_POST['practica'];
        $obs = $_POST['obs'];

        // Insertar la asignación en la tabla notas
        $sqlInsertNotas = "INSERT INTO notas (usuario_id, asignatura_id, parcial, teoria, practica, obs) 
                           VALUES ($usuario_id, $asignatura_id, $parcial, $teoria, $practica, '$obs')";
        if ($conn->query($sqlInsertNotas) === TRUE) {
            // Mensaje de éxito almacenado en una variable de sesión
            $_SESSION['mensaje'] = "Asignación de notas exitosa";
            header("Location: docente.php?section=asignar-notas");
            exit();
        } else {
            // Mensaje de error almacenado en una variable de sesión
            $_SESSION['error'] = "Error al asignar notas: " . $conn->error;
        }
    }
}

// Consulta SQL para obtener la lista de estudiantes
$resultEstudiantes = $conn->query("SELECT * FROM usuarios WHERE rol = 2");

// Consulta SQL para obtener la lista de asignaturas
$resultAsignaturas = $conn->query("SELECT * FROM asignaturas");

// Consulta SQL para obtener la lista de notas
$resultNotas = $conn->query("SELECT notas.id, usuarios.nombre as estudiante, asignaturas.nombre as asignatura, parcial, teoria, practica, notas.obs
                             FROM notas
                             INNER JOIN usuarios ON notas.usuario_id = usuarios.id
                             INNER JOIN asignaturas ON notas.asignatura_id = asignaturas.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_docente.css">
    <link rel="stylesheet" href="css/styles_asignar_notas.css">
    <title>Asignar Notas</title>
</head>
<body>

<!-- Contenedor principal -->
<div class="contenedor-principal">

    <!-- Sección izquierda: Formulario de asignación de notas -->
    <div class="seccion-izquierda">
        <h2>Asignar Notas</h2>

        <!-- Mensaje de éxito o error -->
        <div id="mensaje"><?php echo isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : (isset($_SESSION['error']) ? $_SESSION['error'] : ''); ?></div>

        <form method="post" action="procesar_asignar_notas.php">
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

            <label for="parcial">Parcial:</label>
            <select id="parcial" name="parcial" required>
                <option value="1">1er Parcial</option>
                <option value="2">2do Parcial</option>
                <option value="3">Mejoramiento</option>
            </select>

            <label for="teoria">Teoría:</label>
            <input type="number" step="0.01" id="teoria" name="teoria" required>

            <label for="practica">Práctica:</label>
            <input type="number" step="0.01" id="practica" name="practica" required>

            <label for="obs">Observación:</label>
            <textarea id="obs" name="obs" rows="4"></textarea>

            <div style="text-align: center; margin-top: 10px;">
                <input type="submit" name="submit" class="btn-guardar" value="Guardar Notas">
            </div>
        </form>
    </div>

    <!-- Sección derecha: Tabla de asignación de notas -->
    <div class="seccion-derecha">
        <h2>Lista de Notas</h2>
        <?php
        if ($resultNotas->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Estudiante</th>
                        <th>Asignatura</th>
                        <th>Parcial</th>
                        <th>Teoría</th>
                        <th>Práctica</th>
                        <th>Observación</th>
                    </tr>";

            while ($row = $resultNotas->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['estudiante']}</td>
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

</div>

</body>
</html>

<?php
// Limpiar mensajes después de mostrarlos
unset($_SESSION['mensaje']);
unset($_SESSION['error']);
?>
