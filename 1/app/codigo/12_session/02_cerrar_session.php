<?php
/*
 * Cerrar la sesión
 * --------------------------------------------------------------------
 * Cuando se desea borrar la información que hay en la sesión
 * (por ejemplo, cuando el usuario sale del sistema) se utiliza:
 *
 *   session_unset()   -> borra todas las variables de la sesión
 *   session_destroy() -> destruye la sesión
 */

session_start(); // Primero hay que recuperar la sesión existente

echo "<h1>Cerrar sesión</h1>";

echo "<h2>Antes de borrar</h2><pre>";
var_dump($_SESSION);
echo "</pre>";

session_unset();   // Borra todas las variables de la sesión
session_destroy(); // Borra la sesión

echo "<h2>Después de borrar</h2><pre>";
var_dump($_SESSION); // Ya está vacío
echo "</pre>";

echo "<p>La sesión fue cerrada. Si volvés a la página anterior, el contador
      de visitas arranca de nuevo.</p>";
?>

<hr>
<p><a href="01_session_basica.php">Volver al ejemplo de sesión</a></p>
