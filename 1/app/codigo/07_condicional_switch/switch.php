<?php
/*
 * Condicionales: SWITCH
 * --------------------------------------------------------------------
 * El switch lo utilizamos cuando puede haber varias acciones de acuerdo
 * al valor que tome nuestra variable.
 *
 * IMPORTANTE: cada case termina con break. Si se omite, la ejecución
 * "cae" al siguiente case.
 */

echo "<h1>SWITCH</h1>";

// Ejemplo del apunte, completado con los 12 meses.
$mes = 1;

switch ($mes) {
    case 1:
        echo "Enero<br>";
        break;
    case 2:
        echo "Febrero<br>";
        break;
    case 3:
        echo "Marzo<br>";
        break;
    case 4:
        echo "Abril<br>";
        break;
    case 5:
        echo "Mayo<br>";
        break;
    case 6:
        echo "Junio<br>";
        break;
    case 7:
        echo "Julio<br>";
        break;
    case 8:
        echo "Agosto<br>";
        break;
    case 9:
        echo "Septiembre<br>";
        break;
    case 10:
        echo "Octubre<br>";
        break;
    case 11:
        echo "Noviembre<br>";
        break;
    case 12:
        echo "Diciembre<br>";
        break;
    default:
        echo "Mes inválido<br>";
        break;
}

echo "<h2>Probando todos los valores posibles</h2>";
for ($mes = 0; $mes <= 13; $mes++) {
    echo "\$mes = $mes  ->  ";
    switch ($mes) {
        case 1:  echo "Enero";       break;
        case 2:  echo "Febrero";     break;
        case 3:  echo "Marzo";       break;
        case 4:  echo "Abril";       break;
        case 5:  echo "Mayo";        break;
        case 6:  echo "Junio";       break;
        case 7:  echo "Julio";       break;
        case 8:  echo "Agosto";      break;
        case 9:  echo "Septiembre";  break;
        case 10: echo "Octubre";     break;
        case 11: echo "Noviembre";   break;
        case 12: echo "Diciembre";   break;
        default: echo "Mes inválido"; break;
    }
    echo "<br>";
}

echo "<h2>Varios case compartiendo la misma acción</h2>";
// Ejemplo con el turno de un curso (M: mañana, T: tarde, N: noche).
$turno = "T";

switch ($turno) {
    case "M":
        echo "Turno mañana<br>";
        break;
    case "T":
    case "V": // tarde / vespertino comparten la misma respuesta
        echo "Turno tarde<br>";
        break;
    case "N":
        echo "Turno noche<br>";
        break;
    default:
        echo "Turno inválido<br>";
        break;
}
