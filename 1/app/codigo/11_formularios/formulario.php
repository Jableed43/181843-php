<?php
/*
 * Ejercicio propuesto (Formularios)
 * --------------------------------------------------------------------
 * En el archivo formulario.php hacer un var_dump($_POST).
 * De acuerdo a lo observado, ¿qué es la variable $_POST?
 *
 * RESPUESTA:
 * $_POST es un VECTOR ASOCIATIVO (array) SUPERGLOBAL que PHP arma
 * automáticamente con los datos enviados por un formulario cuyo
 * method es POST. Las CLAVES del vector son los valores del atributo
 * name de cada campo del formulario, y los VALORES son lo que el
 * usuario cargó en ellos. Es superglobal porque está disponible en
 * cualquier ámbito del script sin necesidad de declararla.
 *
 * Su equivalente para el método GET es $_GET, que además muestra los
 * datos en la URL (?nombre=Juan&apellido=Perez).
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos recibidos</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 40px; }
        pre  { background: #f4f4f4; padding: 12px; border: 1px solid #ddd; }
        table { border-collapse: collapse; }
        td, th { border: 1px solid #999; padding: 6px 12px; }
    </style>
</head>
<body>

    <h1>Datos recibidos del formulario</h1>

    <h2>var_dump($_POST)</h2>
    <pre><?php var_dump($_POST); ?></pre>

    <h2>print_r($_POST)</h2>
    <pre><?php print_r($_POST); ?></pre>

    <?php if (!empty($_POST)) : ?>

        <h2>Accediendo a cada campo por separado</h2>
        <table>
            <tr><th>Campo</th><th>Valor recibido</th></tr>
            <tr><td>nombre</td>             <td><?php echo htmlspecialchars($_POST['nombre']); ?></td></tr>
            <tr><td>apellido</td>           <td><?php echo htmlspecialchars($_POST['apellido']); ?></td></tr>
            <tr><td>email</td>              <td><?php echo htmlspecialchars($_POST['email']); ?></td></tr>
            <tr><td>password</td>           <td><?php echo htmlspecialchars($_POST['password']); ?></td></tr>
            <tr><td>confirmar_password</td> <td><?php echo htmlspecialchars($_POST['confirmar_password']); ?></td></tr>
        </table>

        <h2>Una validación simple</h2>
        <?php
        if ($_POST['password'] !== $_POST['confirmar_password']) {
            echo "<p style='color:red'>Las contraseñas no coinciden.</p>";
        } else {
            echo "<p style='color:green'>Las contraseñas coinciden.</p>";
        }
        ?>

        <h2>También podemos recorrerlo con foreach</h2>
        <ul>
            <?php foreach ($_POST as $campo => $valor) : ?>
                <li><strong><?php echo htmlspecialchars($campo); ?>:</strong>
                    <?php echo htmlspecialchars($valor); ?></li>
            <?php endforeach; ?>
        </ul>

    <?php else : ?>

        <p>
            No llegó ningún dato por POST.
            Completá el <a href="formulario.html">formulario</a> y enviálo.
        </p>

    <?php endif; ?>

    <hr>
    <p><a href="formulario.html">Volver al formulario</a></p>

</body>
</html>
