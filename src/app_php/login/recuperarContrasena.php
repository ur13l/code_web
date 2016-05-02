<?php
#Autor: Uriel Infante
#Servicio para enviar un correo con el código de contraseña necesitado por el usuario.
#Recibe mediante POST el parámetro correo.
#Fecha: 21/04/2016

include("../conexion/conexion.php");
include("./enviarCorreo.php");
$conexion = connect();
$correo = $_POST["correo"];
$consulta = "select c.codigo from codigo_login_password c, login_app l WHERE l.correo =
  '$correo' AND l.id_login_app = c.id_login_app; ";
$result = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($result);

if(isset($row)){
  //Enviar correo
  $row['status'] = "valid";
  enviar($correo, $row['codigo']);
  echo json_encode($row, true);
}
else{
  $row = array();
  $row['status'] = "invalid";
  echo json_encode($row, true);
}


$conexion->close();

 ?>
