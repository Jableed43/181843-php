<?php
/*
 * Ejercicio propuesto (Constantes)
 * --------------------------------------------------------------------
 * Dentro del script PHP utilizado en el ejercicio anterior, crear una
 * constante _CURSO. Definir esa constante con el valor 2017 y hacer un
 * echo de dicha constante.
 * Intentar modificar una línea debajo el valor de la constante,
 * ¿qué nos arroja en pantalla?
 */

// Las constantes NO llevan $ en su nombre y se definen con define().
define("_CURSO", 2017);

echo "<h1>Constantes en PHP</h1>";
echo "El curso es del año: " . _CURSO . "<br>";

echo "<h2>¿Qué pasa si intento modificarla?</h2>";

/*
 * RESPUESTA:
 * Una constante NO puede modificarse: esa es la diferencia principal con
 * las variables. Al intentar redefinirla, PHP emite un Warning
 * ("Constant _CURSO already defined") y la constante conserva su valor original.
 *
 * En versiones viejas de PHP el mensaje era un Notice; a partir de PHP 8
 * es un Warning. En ningún caso el valor cambia.
 */
define("_CURSO", 2026); // <-- Warning: Constant _CURSO already defined

echo "<br>Después de intentar redefinirla, _CURSO sigue valiendo: " . _CURSO . "<br>";

// Forma segura de verificar si una constante ya existe antes de definirla:
if (!defined("_CURSO")) {
    define("_CURSO", 2026);
} else {
    echo "<br>La constante _CURSO ya estaba definida, no se redefine.<br>";
}

// Las constantes también son sensibles a mayúsculas y minúsculas.
define("_UNIVERSIDAD", "UTN");
define("_universidad", "utn"); // Es OTRA constante distinta

echo "<h2>Sensibilidad a mayúsculas</h2>";
echo "_UNIVERSIDAD = " . _UNIVERSIDAD . "<br>";
echo "_universidad = " . _universidad . "<br>";

// Sintaxis alternativa con la palabra clave const (sólo a nivel de script/clase).
const _MODULO = "Módulo 1: Introducción y nivelación";
echo "<br>" . _MODULO . "<br>";

// Diferencia práctica: una variable SÍ se puede reasignar.
$anio = 2017;
echo "<h2>Comparación con una variable</h2>";
echo "\$anio vale $anio<br>";
$anio = 2026;
echo "Después de reasignar, \$anio vale $anio<br>";
