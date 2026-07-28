<?php
/*
 * Session - ejemplo del apunte
 * --------------------------------------------------------------------
 * La sesión permite mantener información del usuario en el servidor, que
 * se puede utilizar en cualquier página del sitio. Mantiene la información
 * de un único usuario (si realizó el login, su nombre de usuario, etc.).
 *
 * Toda la información se almacena en el vector asociativo especial $_SESSION.
 *
 * IMPORTANTE: session_start() debe ir ANTES de cualquier salida HTML
 * (antes de cualquier echo, print o texto fuera de <?php ?>).
 */

session_start(); // Crea una sesión o recupera una anterior

// Guardamos información en la sesión...
$_SESSION["username"] = "utnalumno";

// ...y la consultamos
echo "<h1>Session</h1>";
echo "Usuario en sesión: " . $_SESSION["username"] . "<br>";

// Podemos guardar cuantas claves queramos.
$_SESSION["color_favorito"] = "azul";
$_SESSION["logueado"]       = true;

echo "<h2>var_dump(\$_SESSION)</h2><pre>";
var_dump($_SESSION);
echo "</pre>";

// Contador de visitas: demuestra que el dato sobrevive entre pedidos.
if (!isset($_SESSION["visitas"])) {
    $_SESSION["visitas"] = 1;
} else {
    $_SESSION["visitas"]++;
}

echo "<h2>Contador de visitas</h2>";
echo "Recargaste esta página " . $_SESSION["visitas"] . " vez/veces.<br>";
echo "<p>Recargá con F5 y vas a ver cómo el número aumenta: el dato queda
      guardado en el servidor entre un pedido y otro.</p>";

echo "<h2>ID de la sesión</h2>";
echo "session_id() = " . session_id() . "<br>";
?>

<hr>
<p>
    <a href="02_cerrar_session.php">Cerrar la sesión (session_unset + session_destroy)</a> |
    <a href="formulario.html">Ir al ejercicio del formulario en sesión</a>
</p>
