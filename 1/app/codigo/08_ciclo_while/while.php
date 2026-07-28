<?php
/*
 * Ciclos: WHILE
 * --------------------------------------------------------------------
 * El ciclo while ejecutará el código que tiene en su cuerpo mientras la
 * condición sea true.
 *
 * CUIDADO: si dentro del cuerpo nunca se modifica la variable de control,
 * la condición nunca se vuelve falsa y se genera un bucle infinito.
 */

echo "<h1>Ciclo WHILE</h1>";

// Ejemplo del apunte: imprime del 0 al 9.
$i = 0;
while ($i < 10) {
    echo $i;
    $i++;
}
echo "<br>";

echo "<h2>Con separador, para leerlo mejor</h2>";
$i = 0;
while ($i < 10) {
    echo $i . " ";
    $i++;
}
echo "<br>";

echo "<h2>Cuenta regresiva</h2>";
$i = 10;
while ($i > 0) {
    echo $i . " ";
    $i--;
}
echo "¡Despegue!<br>";

echo "<h2>Recorriendo un vector con while</h2>";
$numeros = [1, 30, 22, 94];
$i = 0;
while ($i < count($numeros)) {
    echo "Posición $i -> " . $numeros[$i] . "<br>";
    $i++;
}

echo "<h2>Acumulador: suma de los números del 1 al 100</h2>";
$suma = 0;
$i = 1;
while ($i <= 100) {
    $suma += $i;
    $i++;
}
echo "La suma de 1 a 100 es: $suma<br>"; // 5050
