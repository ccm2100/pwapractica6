<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clase_practica4";
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
