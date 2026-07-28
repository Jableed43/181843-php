<?php
/*
 * Operadores de asignación
 * --------------------------------------------------------------------
 * =    Asigna el valor de la derecha al operando de la izquierda
 * +=   Suma y asigna
 * -=   Resta y asigna
 * ++   Incrementa en 1
 * --   Decrementa en 1
 * .=   Concatena y asigna (cadenas)
 */

echo "<h1>Operadores de asignación</h1>";

// = asignación simple
$nombre = "Juan";
echo "\$nombre = \"Juan\"  ->  $nombre <br>";

// += suma y asigna
$numero = 10;
$numero += 3;
echo "\$numero += 3  ->  $numero <br>"; // 13

// -= resta y asigna
$numero -= 5;
echo "\$numero -= 5  ->  $numero <br>"; // 8

// ++ incremento en 1
$numero++;
echo "\$numero++      ->  $numero <br>"; // 9

// -- decremento en 1
$numero--;
echo "\$numero--      ->  $numero <br>"; // 8

// .= concatenación y asignación
$nombre .= ", Pérez";
echo "\$nombre .= \", Pérez\"  ->  $nombre <br>"; // Juan, Pérez

echo "<h2>Pre-incremento vs post-incremento</h2>";
$a = 5;
echo "\$a vale $a<br>";
echo "echo \$a++ imprime " . $a++ . " y después \$a vale $a<br>"; // imprime 5, queda 6

$b = 5;
echo "\$b vale $b<br>";
echo "echo ++\$b imprime " . ++$b . " y después \$b vale $b<br>"; // imprime 6, queda 6
