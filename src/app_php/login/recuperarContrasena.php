<?php
#Autor: Uriel Infante
#Servicio para enviar un correo con el código de contraseña necesitado por el usuario.
#Recibe mediante POST el parámetro correo.
#Fecha: 21/04/2016

include("../conexion/conexion.php");
include("./enviarCorreo.php");
$conexion = connect();
$correo = $_POST["correo"];
//Se obtiene el id del usuario con su correo.
$consulta = "select id_login_app FROM login_app WHERE correo = '$correo';";
$result = mysqli_query($conexion, $consulta);
$id = mysqli_fetch_row($result)[0];

//Generación de un nuevo código a ser enviado.
$consulta = "update codigo_login_password set codigo = SUBSTR(UUID(),1,5), caducidad = DATE_ADD(NOW(),INTERVAL 1 HOUR) WHERE id_login_app = '$id'";
$result = mysqli_query($conexion, $consulta);

//Se obtiene el nuevo código
$consulta = "select codigo from codigo_login_password WHERE id_login_app = '$id' ";
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
