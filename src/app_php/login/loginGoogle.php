<?php
#Autor: Uriel Infante
#Servicio para validar un logueo mediante facebook, devuelve un json con
#la información del logueo.
#Parámetros: correo
#Fecha: 16/04/2016

include("../conexion/conexion.php");
$conexion = connect();
$data = json_decode(file_get_contents('php://input'), true);
$correo = $data["correo"];

$consulta = "SELECT id, correo, facebook, google FROM login_app WHERE correo = '$correo'
    AND facebook = 0 AND google = 1";

$result = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($result);

if(isset($row)){
  $row['success'] = true;
  echo json_encode($row, true);
}
else{
  $row = array();
  $row['success'] = false;
  echo json_encode($row, true);
}


$conexion->close();

 ?>
