<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>opiniones</title>
  <style>
    body { font-family: Arial; background-color: #f9f9f9; padding: 40px; }
    form { background: white; padding: 20px; border-radius: 10px; width: 300px; margin: auto; }
    input { width: 100%; padding: 8px; margin: 10px 0; }
    button { background-color: #4CAF50; color: white; padding: 10px; border: none; width: 100%; }
    h3 { text-align: center; }  
  </style>
</head>
<body>
<h3>Deja tu opinión </h3>
  <form action="gup.php" method="POST">
  <input type="text" name="nombre" placeholder="Tu nombre" required><br><br>
  <input type="text" name="comentario" placeholder="Escribe tu comentario..." required></input><br><br>
  <input type="submit" name="accion" value="Agregar">
</form>


</body>
</html>