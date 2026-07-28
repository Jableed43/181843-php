<?php
/*
 * Condicionales: IF / ELSE
 * --------------------------------------------------------------------
 * Utilizamos condicionales para tomar alguna decisión en el código.
 * Con if/else no sólo tomamos una acción si la condición se cumple,
 * sino también en caso de que NO se cumpla.
 */

echo "<h1>IF / ELSE</h1>";

// Ejemplo del apunte
$bateria = 85;

if ($bateria > 80) {
    echo "Actualizando sistema...<br>";
} else {
    echo "Batería baja. Conecte el cargador.<br>";
}

echo "<h2>Cambiando el valor de la variable</h2>";
$bateria = 35;

if ($bateria > 80) {
    echo "Actualizando sistema...<br>";
} else {
    echo "Batería baja. Conecte el cargador.<br>";
}

echo "<h2>IF simple (sin else)</h2>";
$edad = 20;
if ($edad >= 18) {
    echo "Es mayor de edad.<br>";
}

echo "<h2>IF / ELSEIF / ELSE</h2>";
$nota = 7;

if ($nota >= 9) {
    echo "Nota $nota: Excelente<br>";
} elseif ($nota >= 6) {
    echo "Nota $nota: Aprobado<br>";
} elseif ($nota >= 4) {
    echo "Nota $nota: Regular<br>";
} else {
    echo "Nota $nota: Desaprobado<br>";
}

echo "<h2>Condición con operadores lógicos</h2>";
$usuario = "admin";
$clave   = "1234";

if ($usuario == "admin" && $clave == "1234") {
    echo "Bienvenido, $usuario.<br>";
} else {
    echo "Usuario o contraseña incorrectos.<br>";
}

echo "<h2>Operador ternario (if/else abreviado)</h2>";
$bateria = 90;
echo ($bateria > 80) ? "Batería OK<br>" : "Batería baja<br>";
