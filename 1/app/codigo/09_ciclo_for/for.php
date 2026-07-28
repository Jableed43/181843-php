<?php
/*
 * Ciclos: FOR
 * --------------------------------------------------------------------
 * Es el ciclo más utilizado. Está compuesto por 3 elementos:
 *   1. Inicialización:          $i = 0;
 *   2. Condición de fin:        $i < 10;
 *   3. Modificador por iteración: $i++
 *
 * El ciclo itera mientras la condición de fin sea true.
 */

echo "<h1>Ciclo FOR</h1>";

// Ejemplo del apunte: imprime del 0 al 9.
for ($i = 0; $i < 10; $i++) {
    echo $i;
}
echo "<br>";

echo "<h2>Con separador, para leerlo mejor</h2>";
for ($i = 0; $i < 10; $i++) {
    echo $i . " ";
}
echo "<br>";

echo "<h2>De 1 a 10 (en vez de 0 a 9)</h2>";
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br>";

echo "<h2>Incrementando de a 2</h2>";
for ($i = 0; $i <= 20; $i += 2) {
    echo $i . " ";
}
echo "<br>";

echo "<h2>Cuenta regresiva</h2>";
for ($i = 10; $i > 0; $i--) {
    echo $i . " ";
}
echo "¡Despegue!<br>";

echo "<h2>Tabla de multiplicar del 5</h2>";
for ($i = 1; $i <= 10; $i++) {
    echo "5 x $i = " . (5 * $i) . "<br>";
}

echo "<h2>Recorriendo un vector con for</h2>";
$numeros = [1, 30, 22, 94];
for ($i = 0; $i < count($numeros); $i++) {
    echo "Posición $i -> " . $numeros[$i] . "<br>";
}

echo "<h2>FOR anidado: tablas del 1 al 3</h2>";
for ($tabla = 1; $tabla <= 3; $tabla++) {
    echo "<strong>Tabla del $tabla</strong><br>";
    for ($i = 1; $i <= 10; $i++) {
        echo "$tabla x $i = " . ($tabla * $i) . "<br>";
    }
    echo "<br>";
}
