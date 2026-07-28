<?php
/*
 * Ejercicio propuesto (Funciones)
 * --------------------------------------------------------------------
 * Crear una función que reciba por parámetro 2 strings, los concatene y
 * luego los imprima por pantalla. Desarrollar la función y el llamado a la misma.
 */

/**
 * Recibe dos cadenas, las concatena y las imprime por pantalla.
 */
function concatenarEImprimir($texto1, $texto2)
{
    $resultado = $texto1 . " " . $texto2;
    echo $resultado . "<br>";
}

echo "<h1>Función que concatena dos strings</h1>";

// Llamados a la función
concatenarEImprimir("Hola", "mundo");
concatenarEImprimir("Juan", "Pérez");
concatenarEImprimir("Programador Web", "Avanzado");

/*
 * Variante: en lugar de imprimir dentro de la función, la retornamos.
 * Suele ser mejor práctica, porque separa el cálculo de la presentación:
 * la función se puede reutilizar aunque el resultado no vaya a la pantalla.
 */
function concatenar($texto1, $texto2)
{
    return $texto1 . " " . $texto2;
}

echo "<h2>Variante con return</h2>";
$nombreCompleto = concatenar("Juan", "Pérez");
echo $nombreCompleto . "<br>";
echo strtoupper($nombreCompleto) . "<br>"; // se puede seguir procesando
