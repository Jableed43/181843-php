<!-- Este archivo permite la conexion con la base de datos -->
 <?php
 // Servidor, el usuario, contraseña, nombre de la base de datos
 $conexion = mysqli_connect("localhost", "root", "", "clase1");

 if(!$conexion){
    die("Error de conexión: " . mysqli_connect_error());
 }