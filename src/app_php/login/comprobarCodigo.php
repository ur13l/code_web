<?php
#Autor: Uriel Infante
#Script para verificar si un código coincide con un correo para la restauración
#de contraseña.
#Recibe mediante POST los parámetros correo y código
#Fecha: 26/04/2016

include("../conexion/conexion.php");
$conexion = connect();
$correo = $_POST["correo"];
$codigo = $_POST["codigo"];
$consulta = "SELECT * FROM codigo_login_password WHERE correo = '$correo'
    AND  codigo = '$codigo'";
$result = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($result);

if(isset($row)){
  echo "true";
}
else{
  echo "false";
}
$conexion->close();

 ?>
