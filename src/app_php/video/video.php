<?php
#Autor: Uriel Infante
#Script que revisa si la fecha de actualización del video es superior a la
#última descarga
#Recibe mediante POST la última actualización del dispositivo
#Fecha: 17/06/2016

include("../conexion/conexion.php");
$conexion = connect();
$fecha = $_POST["fecha_actualizacion"];
$consulta = "SELECT fecha_actualizacion from video WHERE id_video = 1 AND '$fecha' < fecha_actualizacion";
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
