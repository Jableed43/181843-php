<?php
/*
 * Ejercicio propuesto (Session) - paso 1
 * --------------------------------------------------------------------
 * Recibe los datos del formulario por POST y los almacena en $_SESSION.
 *
 * NO OLVIDAR el session_start(), y que debe ir antes de cualquier
 * salida HTML.
 */

session_start();

// Guardamos en sesión cada dato recibido del formulario.
if (!empty($_POST)) {
    $_SESSION["nombre"]   = $_POST["nombre"];
    $_SESSION["apellido"] = $_POST["apellido"];
    $_SESSION["email"]    = $_POST["email"];
    $_SESSION["password"] = $_POST["password"];

    /*
     * Nota: guardar una contraseña en texto plano se hace acá sólo para
     * ver el ejercicio. En una aplicación real se guarda su hash, por
     * ejemplo con password_hash($_POST["password"], PASSWORD_DEFAULT).
     */

    // También podríamos guardar todo el POST de una sola vez:
    // $_SESSION["datos_registro"] = $_POST;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos guardados en sesión</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 40px; }
        pre  { background: #f4f4f4; padding: 12px; border: 1px solid #ddd; }
    </style>
</head>
<body>

    <h1>Datos guardados en sesión</h1>

    <?php if (!empty($_POST)) : ?>
        <p style="color:green">Los datos del formulario se guardaron en $_SESSION.</p>

        <h2>Lo que llegó por POST</h2>
        <pre><?php var_dump($_POST); ?></pre>

        <h2>Lo que quedó en la sesión</h2>
        <pre><?php var_dump($_SESSION); ?></pre>

        <p>
            Ahora abrí
            <a href="formulario_session.php">formulario_session.php</a>:
            vas a ver que los datos siguen disponibles en otra página,
            aunque ahí no se envió ningún formulario.
        </p>
    <?php else : ?>
        <p>No llegó ningún dato. Completá el
           <a href="formulario.html">formulario</a>.</p>
    <?php endif; ?>

</body>
</html>
