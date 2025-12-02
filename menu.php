<?php
include("conexion.php");

// Procesar acciones
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'];

    if ($accion === 'editar') {
        $nuevoComentario = $_POST['comentario'];
        $sql = "UPDATE comentarios SET comentario=? WHERE nombre=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nuevoComentario, $nombre);
        $stmt->execute();
        $stmt->close();
    }

    if ($accion === 'eliminar') {
        $sql = "DELETE FROM comentarios WHERE nombre=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->close();
    }
}

// Consultar todos los comentarios
$sql = "SELECT nombre, comentario FROM comentarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de comentarios</title>
    <style>
        table { border-collapse: collapse; width: 70%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        select, textarea, button, input { margin: 5px; }
        textarea { width: 90%; height: 50px; }
        .menu { width: 70%; margin: 20px auto; text-align: center; border: 1px solid #ccc; padding: 15px; }

    </style>
</head>
<body>
    <h2 style="text-align:center;">Lista de comentarios</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Comentario</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
            <td><?php echo htmlspecialchars($row['comentario']); ?></td>
        </tr>
        <?php } ?>
    </table>

    <!-- Menú de gestión debajo de la tabla -->
    <div class="menu">
        <h3>Gestionar comentario</h3>
        <form method="POST" action="menu.php" onsubmit="return validarAccion(this);">
            <input type="text" name="nombre" placeholder="Tu nombre" required><br>
            
            <select name="accion" onchange="toggleComentario(this)">
                <option value="">Selecciona acción...</option>
                <option value="editar">Editar</option>
                <option value="eliminar">Eliminar</option>
            </select><br>

            <textarea name="comentario" style="display:none;" placeholder="Nuevo comentario..."></textarea><br>

            <button type="submit">Aplicar</button>
        </form>
        <form action="index.php" method="get">
        <button type="submit">Regresar al formulario</button>
    </form>
    </div>

    <script>
        // Mostrar/ocultar textarea según acción
        function toggleComentario(select) {
            const form = select.closest("form");
            const textarea = form.querySelector("textarea");
            if (select.value === "editar") {
                textarea.style.display = "block";
            } else {
                textarea.style.display = "none";
            }
        }

        // Validar acción
        function validarAccion(form) {
            const accion = form.querySelector("select").value;
            if (accion === "") {
                alert("Debes seleccionar una acción.");
                return false;
            }
            if (accion === "eliminar") {
                return confirm("¿Seguro que deseas eliminar este comentario?");
            }
            return true;
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>


