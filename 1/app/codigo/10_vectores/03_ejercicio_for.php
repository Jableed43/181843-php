<?php
/*
 * Ejercicio propuesto (Vectores) - parte 1
 * --------------------------------------------------------------------
 * Crear un script PHP con un vector vacío y completarlo con los números
 * 1, 2, 3, 4, 5 usando el bucle FOR.
 */

echo "<h1>Vector completado con FOR</h1>";

// 1) Vector vacío
$numeros = [];

// 2) Lo completamos con los números del 1 al 5
for ($i = 1; $i <= 5; $i++) {
    $numeros[] = $i; // agrega al final del vector
}

// 3) Mostramos el resultado
echo "<h2>print_r</h2><pre>";
print_r($numeros);
echo "</pre>";

echo "<h2>var_dump</h2><pre>";
var_dump($numeros);
echo "</pre>";

echo "<h2>Recorriendo el resultado</h2>";
for ($i = 0; $i < count($numeros); $i++) {
    echo "Índice $i -> Valor " . $numeros[$i] . "<br>";
}

/*
 * Observación: el índice arranca en 0 y el valor en 1, porque el vector
 * comienza siempre en la posición 0 mientras que nosotros cargamos
 * los valores desde el 1.
 */

// Variante indicando explícitamente el índice.
echo "<h2>Variante asignando el índice a mano</h2>";
$numeros2 = [];
for ($i = 0; $i < 5; $i++) {
    $numeros2[$i] = $i + 1;
}
echo "<pre>";
print_r($numeros2);
echo "</pre>";
