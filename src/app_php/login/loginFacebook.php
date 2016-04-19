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
    AND facebook = 1 AND google = 0";

$result = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($result);

if(isset($row)){
  echo json_encode($row, true);
}

//Si la consulta no encuentra un registro, lo genera.
else{
  $consulta = "SELECT id_login_app FROM login_app WHERE correo = '$correo'";
  $result = mysqli_query($conexion, $consulta);
  $row = mysqli_fetch_array($result);
  if(!isset($row)){
    $consulta = "INSERT INTO login_app (correo, facebook, google) VALUES
          ('$correo', 1, 0);";
    $result = mysqli_query($conexion, $consulta);

    $consulta = "SELECT id_login_app, correo, facebook, google FROM login_app WHERE correo = '$correo'
        AND facebook = 1 AND google = 0";

    $result = mysqli_query($conexion, $consulta);
    $row = mysqli_fetch_array($result);
    echo json_encode($row, true);
  }
  else{
    $row = array('id_login_app'=>-1);
    echo json_encode($row, true);
  }
}



$conexion->close();

 ?>
