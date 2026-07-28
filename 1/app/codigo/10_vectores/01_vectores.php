<?php
/*
 * Vectores (arrays)
 * --------------------------------------------------------------------
 * Un vector es una zona de almacenamiento contiguo que contiene una serie
 * de elementos. Lo usamos cuando queremos guardar más de un valor en una
 * misma variable.
 *
 * LOS VECTORES COMIENZAN DESDE LA POSICIÓN 0
 *
 * Están compuestos por 2 elementos:
 *   - Clave o índice: identifica la posición (0, 1, 2, ...)
 *   - Valor: el dato propiamente dicho
 */

echo "<h1>Vectores</h1>";

// Ejemplo del apunte: números para jugar al loto.
$numeros = [1, 30, 22, 94];

echo "<h2>Contenido del vector</h2><pre>";
print_r($numeros);
echo "</pre>";

echo "<h2>Accediendo por índice</h2>";
echo "\$numeros[0] = " . $numeros[0] . "<br>"; // 1
echo "\$numeros[1] = " . $numeros[1] . "<br>"; // 30
echo "\$numeros[2] = " . $numeros[2] . "<br>"; // 22
echo "\$numeros[3] = " . $numeros[3] . "<br>"; // 94

echo "<h2>Cantidad de elementos</h2>";
echo "count(\$numeros) = " . count($numeros) . "<br>";

echo "<h2>Agregando elementos</h2>";
$numeros[] = 77;          // agrega al final
$numeros[5] = 12;         // agrega en un índice puntual
echo "<pre>";
print_r($numeros);
echo "</pre>";

echo "<h2>Modificando un elemento</h2>";
$numeros[0] = 100;
echo "Ahora \$numeros[0] = " . $numeros[0] . "<br>";

echo "<h2>Recorriendo el vector con foreach</h2>";
foreach ($numeros as $indice => $valor) {
    echo "Índice $indice -> Valor $valor<br>";
}

echo "<h2>var_dump del vector</h2><pre>";
var_dump($numeros);
echo "</pre>";

echo "<h2>Sintaxis antigua: array()</h2>";
$colores = array("rojo", "verde", "azul");
echo "<pre>";
print_r($colores);
echo "</pre>";
