<?php
require "conexion.php";

$resultado = mysqli_query($conexion, "SELECT * FROM alumnos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de alumnos</title>
</head>
<body>
    <h1>Listado de alumnos</h1>
    <table border="1">
    <tr>
        <th>
            ID
        </th>
        <th>
            Nombre
        </th>
        <th>
            Email
        </th>
        <th>
            Edad
        </th>
    </tr>
    <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
        <tr>
            <td> <?php echo $fila['id']; ?> </td>
            <td> <?php echo htmlspecialchars($fila['nombre']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['email']); ?> </td>
            <td> <?php echo ($fila['edad']); ?> </td>
        </tr>
    <?php endwhile; ?>
    </table>
    <p> <a href="formulario.html">Cargar otro alumno</a> </p>
</body>
</html>