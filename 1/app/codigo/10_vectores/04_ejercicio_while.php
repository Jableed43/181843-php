<?php
/*
 * Ejercicio propuesto (Vectores) - parte 2
 * --------------------------------------------------------------------
 * Crear un script PHP con un vector vacío y completarlo con los números
 * 1, 2, 3, 4, 5 usando el bucle WHILE.
 */

echo "<h1>Vector completado con WHILE</h1>";

// 1) Vector vacío
$numeros = [];

// 2) Lo completamos con los números del 1 al 5
$i = 1;
while ($i <= 5) {
    $numeros[] = $i;
    $i++; // sin esta línea el ciclo sería infinito
}

// 3) Mostramos el resultado
echo "<h2>print_r</h2><pre>";
print_r($numeros);
echo "</pre>";

echo "<h2>var_dump</h2><pre>";
var_dump($numeros);
echo "</pre>";

echo "<h2>Recorriendo el resultado con while</h2>";
$i = 0;
while ($i < count($numeros)) {
    echo "Índice $i -> Valor " . $numeros[$i] . "<br>";
    $i++;
}

/*
 * Diferencia con el for:
 * El resultado es idéntico. Cambia sólo dónde se escriben las tres partes
 * del ciclo: en el for van juntas en la cabecera, en el while la
 * inicialización va antes y el incremento dentro del cuerpo.
 */
