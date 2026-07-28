<?php
/*
 * Ejercicio propuesto (Session) - paso 2
 * --------------------------------------------------------------------
 * Hacer un var_dump($_SESSION) en el archivo formulario_session.php
 * (tampoco olvidar hacer el session_start() aquí).
 *
 * OBSERVACIÓN CLAVE:
 * A este archivo NO se le envió ningún formulario, y sin embargo los datos
 * están disponibles. Eso es lo que aporta la sesión: la información queda
 * guardada en el SERVIDOR y se puede consultar desde cualquier página del
 * sitio mientras la sesión siga viva.
 *
 * Si se quita el session_start() de este archivo, $_SESSION aparece vacío.
 */

session_start(); // Sin esta línea $_SESSION estaría vacío
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>var_dump($_SESSION)</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 40px; }
        pre  { background: #f4f4f4; padding: 12px; border: 1px solid #ddd; }
    </style>
</head>
<body>

    <h1>Contenido de la sesión</h1>

    <h2>var_dump($_SESSION)</h2>
    <pre><?php var_dump($_SESSION); ?></pre>

    <h2>print_r($_SESSION)</h2>
    <pre><?php print_r($_SESSION); ?></pre>

    <?php if (!empty($_SESSION)) : ?>
        <h2>Accediendo a un dato puntual</h2>
        <p>
            Hola <?php echo htmlspecialchars($_SESSION["nombre"] ?? ""); ?>
            <?php echo htmlspecialchars($_SESSION["apellido"] ?? ""); ?>,
            tu email registrado es
            <?php echo htmlspecialchars($_SESSION["email"] ?? ""); ?>.
        </p>
    <?php else : ?>
        <p>
            La sesión está vacía. Completá primero el
            <a href="formulario.html">formulario</a>.
        </p>
    <?php endif; ?>

    <hr>
    <p>
        <a href="formulario.html">Volver al formulario</a> |
        <a href="02_cerrar_session.php">Cerrar la sesión</a>
    </p>

</body>
</html>
