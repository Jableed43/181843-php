<?php
/*
 * Operadores de comparación
 * --------------------------------------------------------------------
 * ==   Igual a          $edad == 33
 * !=   Distinto de      $edad != 33
 * <    Menor que        $edad <  33
 * <=   Menor o igual    $edad <= 33
 * >    Mayor que        $edad >  33
 * >=   Mayor o igual    $edad >= 33
 *
 * Devuelven TRUE (verdadero) o FALSE (falso).
 * Nota: al imprimir con echo, TRUE se muestra como 1 y FALSE como cadena vacía.
 * Por eso acá usamos var_export() para verlos claramente.
 */

$edad = 33;

echo "<h1>Operadores de comparación (\$edad = $edad)</h1>";

echo "\$edad == 33  ->  " . var_export($edad == 33, true) . "<br>"; // true
echo "\$edad != 33  ->  " . var_export($edad != 33, true) . "<br>"; // false
echo "\$edad <  33  ->  " . var_export($edad <  33, true) . "<br>"; // false
echo "\$edad <= 33  ->  " . var_export($edad <= 33, true) . "<br>"; // true
echo "\$edad >  33  ->  " . var_export($edad >  33, true) . "<br>"; // false
echo "\$edad >= 33  ->  " . var_export($edad >= 33, true) . "<br>"; // true

echo "<h2>Cómo se ve TRUE/FALSE con echo</h2>";
echo "echo (\$edad == 33) imprime: [" . ($edad == 33) . "]<br>"; // [1]
echo "echo (\$edad != 33) imprime: [" . ($edad != 33) . "]<br>"; // [] cadena vacía

echo "<h2>Extra: == (igualdad) vs === (identidad)</h2>";
// == compara sólo el valor; === compara valor Y tipo de dato.
var_dump("33" == 33);  // true  -> mismo valor
var_dump("33" === 33); // false -> distinto tipo (string vs int)
