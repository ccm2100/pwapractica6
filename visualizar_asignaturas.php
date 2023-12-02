<?php
// Incluir el archivo de conexión
include('conexion.php');

// Lógica para manejar la creación de asignaturas y eliminación si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Lógica para crear asignatura...
    } elseif (isset($_POST['eliminar'])) {
        // Lógica para eliminar asignatura...
        $id_eliminar = $_POST['id_eliminar'];
        $sqlEliminar = "DELETE FROM asignaturas WHERE id = $id_eliminar";
        if ($conn->query($sqlEliminar) === TRUE) {
            // La eliminación fue exitosa
            echo "<div class='mensaje-eliminacion'>Asignatura eliminada correctamente</div>";
        } else {
            echo "Error al eliminar la asignatura: " . $conn->error;
        }
    }
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
    <link rel="stylesheet" href="css/styles_visualizar_asignaturas.css">
    <title>Visualizar Asignaturas</title>
</head>
<body>

<div class="content">
    <h2>Asignaturas</h2>

    <?php
    // Mostrar el contenido según la lógica implementada
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['obs']}</td>
                    <td>
                        <form method='post' onsubmit='return confirmarEliminar({$row['id']})'>
                            <input type='hidden' name='id_eliminar' value='{$row['id']}'>
                            <button type='submit' name='eliminar' class='btn-eliminar'>Eliminar</button>
                        </form>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No hay asignaturas disponibles.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
</div>

<!-- Añadimos el botón "Crear Asignatura" -->
<button class="btn-crear" onclick="abrirFormulario()">Crear Asignatura</button>

<div id="crearAsignaturaModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarFormulario()">&times;</span>
        <h2>Crear Asignatura</h2>
        <form id="crearAsignaturaForm" method="post" action="procesar_creacion_asignatura.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" name="observaciones" rows="4"></textarea>

            <div style="text-align: center; margin-top: 10px;">
                <input type="submit" name="submit" class="btn-guardar" value="Guardar">
            </div>
        </form>
    </div>
</div>

<script>
    function abrirFormulario() {
        document.getElementById('crearAsignaturaModal').style.display = 'block';
    }

    function cerrarFormulario() {
        document.getElementById('crearAsignaturaModal').style.display = 'none';
    }

    function confirmarEliminar(id) {
        return confirm("¿Estás seguro de eliminar la asignatura?");
    }
</script>

</body>
</html>
