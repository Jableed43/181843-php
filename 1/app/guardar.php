<!-- Va a tomar los campos del formulario y enviarlos a la base de datos -->
 <?php
 require "conexion.php";

//  Cuales son los campos del formulario?
// mysqli_real_escape_string -> evita SQL injection
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$email = mysqli_real_escape_string($conexion, $_POST['email']);
$edad = (int) $_POST['edad'];

// Digo cual va a ser mi consulta para la base de datos
$sql = "INSERT INTO alumnos (nombre, email, edad) VALUES ('$nombre', '$email', '$edad')";

// Ejecutar la consulta para la base de datos
mysqli_query($conexion, $sql);

// Me redirecciona a un listado de los alumnos
header("Location: listado.php");