<?php
#Autor: Uriel Infante
#Servicio para realizar el inicio de sesión simple, devuelve la información
#de un login en formato JSON.
#Recibe mediante POST los parámetros correo y password
#Fecha: 16/04/2016

include("../conexion/conexion.php");
$conexion = connect();
$data = json_decode(file_get_contents('php://input'), true);
$correo = $_POST["correo"];
$password = $_POST['password'];
$consulta = "SELECT id_login_app, correo, facebook, google FROM login_app WHERE correo = '$correo'
    AND password = MD5('$password') AND facebook = 0 AND google = 0";
$result = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($result);

if(isset($row)){
  $row['id_login_app'] = 1;
  echo json_encode($row, true);
}
else{
  $row = array();
  $row['id_login_app'] = 0;
  echo json_encode($row, true);
}


$conexion->close();

 ?>
