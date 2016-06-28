<?php
#Autor: Uriel Infante
#Servicio para realizar el inicio de sesión simple, devuelve la información
#de un login en formato JSON.
#Recibe mediante POST los parámetros correo y password
#Fecha: 16/04/2016

include("../conexion/conexion.php");
$conexion = connect();
$correo = $_POST["correo"];
$password = $_POST['password'];
$consulta = "SELECT id_login_app, correo, facebook, google FROM login_app WHERE correo = '$correo'
    AND password = MD5('$password') AND facebook = 0 AND google = 0";
$result = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($result);

if(isset($row)){
  echo json_encode($row, true);
  $consulta = "INSERT INTO bitacora_login VALUES ('".$row['id_login_app']."', now())";
  $result = mysqli_query($conexion, $consulta);
}
else{
  $row = array();
  $row['id_login_app'] = "0";
  echo json_encode($row, true);
}


$conexion->close();

 ?>
