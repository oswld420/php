<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $comentario = $_POST["comentario"];

    $sql = "INSERT INTO comentarios (nombre, comentario) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en prepare: " . $conn->error);
    }

    $stmt->bind_param("ss", $nombre, $comentario);

        if ($stmt->execute()) {
            echo "<h3>Comentario guardado correctamente.</h3>";
    header("Location: menu.php?mensaje=creado");
    exit;
} else {
    echo "<h3>Error al guardar el usuario: " . $stmt->error . "</h3>";
    header("Location: menu.php?mensaje=error");
    exit;
}

    $stmt->close();
    $conn->close();
}
?>
