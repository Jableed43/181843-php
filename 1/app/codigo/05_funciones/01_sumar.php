<?php
/*
 * Ejemplo del apunte: función que realiza una suma
 * --------------------------------------------------------------------
 * Las funciones son módulos autocontenidos de código para cumplir una
 * determinada operación. Reciben parámetros y retornan un resultado
 * (que puede ser nulo/vacío).
 */

function sumar($a, $b)
{
    return $a + $b;
}

echo "<h1>Función sumar()</h1>";

echo sumar(5, 3);      // 8
echo "<br>";
echo sumar(10, 20);    // 30
echo "<br>";

// El valor retornado se puede guardar en una variable y reutilizar.
$total = sumar(100, 250);
echo "El total es: $total <br>";

// Una función puede no retornar nada (retorna null).
function saludar($nombre)
{
    echo "¡Hola, $nombre!<br>";
}

saludar("Juan");

// Parámetros con valor por defecto.
function multiplicar($a, $b = 2)
{
    return $a * $b;
}

echo "<h2>Parámetro por defecto</h2>";
echo "multiplicar(5)    = " . multiplicar(5) . "<br>";    // 10
echo "multiplicar(5, 4) = " . multiplicar(5, 4) . "<br>"; // 20
