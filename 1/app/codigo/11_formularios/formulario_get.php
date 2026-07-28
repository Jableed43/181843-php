<?php
/*
 * Recepción de datos enviados por el método GET.
 * --------------------------------------------------------------------
 * Observá la barra de direcciones del navegador: los datos aparecen
 * en la URL como ?nombre=Juan&apellido=Perez&email=...
 *
 * | Método | Disponible en variable        |
 * |--------|-------------------------------|
 * | GET    | $_GET['nombre_del_campo']     |
 * | POST   | $_POST['nombre_del_campo']    |
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos recibidos por GET</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 40px; }
        pre  { background: #f4f4f4; padding: 12px; border: 1px solid #ddd; }
    </style>
</head>
<body>

    <h1>Datos recibidos por GET</h1>

    <h2>var_dump($_GET)</h2>
    <pre><?php var_dump($_GET); ?></pre>

    <?php if (!empty($_GET)) : ?>
        <h2>Campos recibidos</h2>
        <ul>
            <?php foreach ($_GET as $campo => $valor) : ?>
                <li><strong><?php echo htmlspecialchars($campo); ?>:</strong>
                    <?php echo htmlspecialchars($valor); ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Fijate que todos estos datos están también en la URL de esta página.</p>
    <?php else : ?>
        <p>No llegó ningún dato. Completá el
           <a href="formulario_get.html">formulario</a>.</p>
    <?php endif; ?>

    <hr>
    <p><a href="formulario_get.html">Volver al formulario</a></p>

</body>
</html>
