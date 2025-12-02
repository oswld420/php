<?php
// Datos de conexión
$servidor = "localhost";  // Servidor local
$usuario = "root";        // Usuario por defecto en XAMPP
$contrasena = "";         // Contraseña vacía por defecto
$baseDatos = "cmt"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);}
    else {
    echo "✅ Conexión exitosa a la base de datos.</a>";


}
// Forzar el charset a utf8mb4 para soportar caracteres y evitar errores de colación
$conn->set_charset("utf8mb4");
?>