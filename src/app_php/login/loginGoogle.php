<?php
#Autor: Uriel Infante
#Servicio para validar un logueo mediante facebook, devuelve un json con
#la información del logueo.
#Parámetros: correo
#Fecha: 16/04/2016

include("../conexion/conexion.php");
$conexion = connect();
$correo = $_POST["correo"];

$consulta = "SELECT id_login_app, correo, facebook, google FROM login_app WHERE correo = '$correo'
    AND facebook = 0 AND google = 1";

$result = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($result);

if(isset($row)){
  echo json_encode($row, true);
}

//Si la consulta no encuentra un registro, lo genera.
else{
  $consulta = "INSERT INTO login_app (correo, facebook, google) VALUES
        ('$correo', 0, 1);";
  $result = mysqli_query($conexion, $consulta);

  $consulta = "SELECT id_login_app, correo, facebook, google FROM login_app WHERE correo = '$correo'
      AND facebook = 0 AND google = 1";

  $result = mysqli_query($conexion, $consulta);
  $row = mysqli_fetch_array($result);
  echo json_encode($row, true);
}



$conexion->close();

 ?>
