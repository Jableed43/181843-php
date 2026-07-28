<?php
/*
 * Operadores lógicos
 * --------------------------------------------------------------------
 * &&   AND: TRUE si se cumplen ambas expresiones
 * ||   OR : TRUE si se cumple al menos una de las expresiones
 * !    NOT: niega el resultado de la expresión
 */

$edad   = 33;
$nombre = "Juan";

echo "<h1>Operadores lógicos (\$edad = $edad, \$nombre = \"$nombre\")</h1>";

// AND
$and = ($edad == 33 && $nombre == "Juan");
echo "\$edad == 33 && \$nombre == \"Juan\"  ->  " . var_export($and, true) . "<br>"; // true

// OR
$or = ($edad < 33 || $edad > 40);
echo "\$edad < 33 || \$edad > 40           ->  " . var_export($or, true) . "<br>";  // false

// NOT
$not = !($edad < 33);
echo "!(\$edad < 33)                       ->  " . var_export($not, true) . "<br>"; // true

echo "<h2>Aplicados en un condicional</h2>";
if ($edad >= 18 && $edad <= 65) {
    echo "La persona está en edad laboral.<br>";
} else {
    echo "La persona NO está en edad laboral.<br>";
}

if ($nombre == "Juan" || $nombre == "Pedro") {
    echo "El nombre está en la lista permitida.<br>";
}

if (!empty($nombre)) {
    echo "La variable \$nombre tiene contenido.<br>";
}

echo "<h2>Tabla de verdad de && y ||</h2>";
echo "<table border='1' cellpadding='5'><tr><th>A</th><th>B</th><th>A &amp;&amp; B</th><th>A || B</th></tr>";
foreach ([true, false] as $a) {
    foreach ([true, false] as $b) {
        echo "<tr>";
        echo "<td>" . var_export($a, true) . "</td>";
        echo "<td>" . var_export($b, true) . "</td>";
        echo "<td>" . var_export($a && $b, true) . "</td>";
        echo "<td>" . var_export($a || $b, true) . "</td>";
        echo "</tr>";
    }
}
echo "</table>";
