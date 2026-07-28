<?php
/*
 * Vectores asociativos
 * --------------------------------------------------------------------
 * En PHP podemos colocar como índices de un vector un string.
 * Eso es lo que se denomina un vector asociativo.
 */

echo "<h1>Vectores asociativos</h1>";

// Ejemplo del apunte
$persona = [
    "nombre"   => "Juan",
    "apellido" => "Pérez",
    "edad"     => 30
];

echo $persona["nombre"] . "<br>"; // Imprime "Juan"

echo "<h2>Accediendo a cada clave</h2>";
echo "nombre   -> " . $persona["nombre"]   . "<br>";
echo "apellido -> " . $persona["apellido"] . "<br>";
echo "edad     -> " . $persona["edad"]     . "<br>";

echo "<h2>Contenido completo</h2><pre>";
print_r($persona);
echo "</pre>";

echo "<h2>Agregando y modificando claves</h2>";
$persona["email"] = "juan.perez@mail.com"; // agrega una clave nueva
$persona["edad"]  = 31;                    // modifica una existente
echo "<pre>";
print_r($persona);
echo "</pre>";

echo "<h2>Recorriéndolo con foreach</h2>";
foreach ($persona as $clave => $valor) {
    echo "$clave: $valor<br>";
}

echo "<h2>Verificar si existe una clave</h2>";
if (isset($persona["dni"])) {
    echo "El DNI es " . $persona["dni"] . "<br>";
} else {
    echo "La clave 'dni' no existe en el vector.<br>";
}

echo "<h2>Array asociativo de arrays (una lista de alumnos)</h2>";
$alumnos = [
    ["nombre" => "Juan",  "apellido" => "Pérez",    "dni" => "30111222", "curso" => "PHP Avanzado"],
    ["nombre" => "Ana",   "apellido" => "Gómez",    "dni" => "31222333", "curso" => "PHP Avanzado"],
    ["nombre" => "Luis",  "apellido" => "Martínez", "dni" => "32333444", "curso" => "Base de Datos"],
];

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Curso</th></tr>";
foreach ($alumnos as $alumno) {
    echo "<tr>";
    echo "<td>" . $alumno["nombre"]   . "</td>";
    echo "<td>" . $alumno["apellido"] . "</td>";
    echo "<td>" . $alumno["dni"]      . "</td>";
    echo "<td>" . $alumno["curso"]    . "</td>";
    echo "</tr>";
}
echo "</table>";
