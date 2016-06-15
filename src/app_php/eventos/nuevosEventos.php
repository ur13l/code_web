<?php
#Autor: Uriel Infante
#Script que trae la información de nuevos eventos cargados en la base de datos.
#Parámetros: Fecha de última actualización.
#Fecha: 12/04/2016

include("../conexion/conexion.php");
$conexion = connect();
$fechaActualizacion = $_POST["fecha_actualizacion"];
$consulta = "SET NAMES UTF8";
mysqli_query($conexion, $consulta);

$consulta = "SELECT * FROM evento WHERE fecha_actualizacion > '$fechaActualizacion'";
$result = mysqli_query($conexion, $consulta);
$eventos = array();


while ($row = mysqli_fetch_array($result)){
//echo json_encode($row);
  array_push($eventos, $row);
}
echo json_encode($eventos, true);
$conexion->close();

 ?>
