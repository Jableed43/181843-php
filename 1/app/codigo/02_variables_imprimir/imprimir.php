<?php
/*
 * Ejercicio propuesto (Variables / Imprimir información por pantalla)
 * --------------------------------------------------------------------
 * Crear un script PHP con la denominación imprimir.php.
 * Crear la variable $mi_nombre, asignar un string con tu nombre e imprimir
 * el contenido de dicha variable por pantalla con echo, print, var_dump y print_r.
 */

// Las variables en PHP comienzan con $ y son sensibles a mayúsculas/minúsculas.
$mi_nombre = "Javier Nehuen López";

echo "<h1>Imprimir información por pantalla</h1>";

// 1) echo: puede imprimir más de una expresión, separadas por coma.
echo "<h2>echo</h2>";
echo $mi_nombre;
echo "<br>";
echo "Mi nombre es: ", $mi_nombre, "<br>"; // varias expresiones separadas por coma

// 2) print: imprime una cadena (y además devuelve el valor 1).
echo "<h2>print</h2>";
print $mi_nombre;
print "<br>";
$resultado = print "print siempre retorna 1<br>";
echo "Valor retornado por print: " . $resultado . "<br>";

// 3) var_dump: muestra tipo de dato y tamaño, además del valor.
echo "<h2>var_dump</h2>";
echo "<pre>";
var_dump($mi_nombre);
echo "</pre>";

// 4) print_r: muestra el valor en un formato legible, sin tipo ni tamaño.
echo "<h2>print_r</h2>";
echo "<pre>";
print_r($mi_nombre);
echo "</pre>";

/*
 * Diferencia entre var_dump y print_r con estructuras complejas:
 * var_dump informa tipo y tamaño de cada elemento; print_r no.
 */
$datos = [
    "nombre" => "Javier",
    "edad"   => 33,
    "activo" => true,
    "notas"  => [8, 9, 10],
];

echo "<h2>var_dump de un array</h2><pre>";
var_dump($datos);
echo "</pre>";

echo "<h2>print_r del mismo array</h2><pre>";
print_r($datos);
echo "</pre>";

// Sensibilidad a mayúsculas y minúsculas: $mi_nombre NO es lo mismo que $Mi_Nombre
$Mi_Nombre = "Otra variable distinta";
echo "<h2>Sensibilidad a mayúsculas</h2>";
echo '$mi_nombre = ' . $mi_nombre . "<br>";
echo '$Mi_Nombre = ' . $Mi_Nombre . "<br>";
