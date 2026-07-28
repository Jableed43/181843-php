<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>01 - Sintaxis básica de PHP</title>
</head>
<body>

    <h1>Sintaxis básica de PHP</h1>

    <?php
    // Todo el código PHP va entre <?php y ?>
    // Cada instrucción termina con ;
    // El archivo debe tener extensión .php para que el intérprete lo procese.

    echo "<p>¡Hola mundo desde PHP!</p>";
    ?>

    <hr>

    <h2>PHP incrustado dentro del HTML</h2>
    <p>La fecha del servidor es: <?php echo date("d/m/Y H:i:s"); ?></p>
    <p>La versión de PHP instalada es: <?php echo phpversion(); ?></p>

    <hr>

    <h2>Cómo funciona PHP (recordatorio)</h2>
    <ol>
        <li>El usuario ingresa la URL en su navegador y presiona ENTER.</li>
        <li>El navegador realiza un pedido HTTP GET al servidor.</li>
        <li>El servidor identifica que la URL llama a un archivo .php.</li>
        <li>El servidor invoca al intérprete PHP con el contenido del archivo.</li>
        <li>El intérprete procesa el código PHP y devuelve HTML.</li>
        <li>El navegador realiza el render del HTML recibido.</li>
    </ol>

</body>
</html>
