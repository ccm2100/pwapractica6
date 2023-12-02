<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_login.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="login-container">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Iniciar Sesión</h2>
        <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p class="error-message">Error en el inicio de sesión. Verifica tus credenciales.</p>';
            }
        ?>
        <form action="validar_login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="1">Docente</option>
                <option value="2">Estudiante</option>
            </select>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>
