<?php
/*
 * Operadores aritméticos
 * --------------------------------------------------------------------
 * +   Suma                            5 + 3   // 8
 * -   Resta                           5 - 3   // 2
 * *   Multiplicación                  5 * 3   // 15
 * /   División                        10 / 5  // 2
 * %   Módulo (resto de la división)   5 % 3   // 2
 * **  Exponenciación                  5 ** 2  // 25
 * .   Concatenación de cadenas
 */

echo "<h1>Operadores aritméticos</h1>";

echo "5 + 3  = " . (5 + 3) . "<br>";   // 8
echo "5 - 3  = " . (5 - 3) . "<br>";   // 2
echo "5 * 3  = " . (5 * 3) . "<br>";   // 15
echo "10 / 5 = " . (10 / 5) . "<br>";  // 2
echo "5 % 3  = " . (5 % 3) . "<br>";   // 2
echo "5 ** 2 = " . (5 ** 2) . "<br>";  // 25

echo "<h2>Concatenación con el punto</h2>";
$nombre = "Juan" . "," . "Pérez";
echo $nombre . "<br>"; // Juan,Pérez

// El módulo es muy útil para saber si un número es par o impar.
echo "<h2>Uso típico del módulo</h2>";
for ($i = 1; $i <= 6; $i++) {
    $tipo = ($i % 2 == 0) ? "par" : "impar";
    echo "$i es $tipo<br>";
}
