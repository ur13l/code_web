<?php
#Autor: Uriel Infante
#Controlador para devolver las notificaciones enviadas anteriormente.
#Fecha: 13/06/2016
#
include("../../app_php/conexion/conexion.php");

$conexion = connect();

$consulta = "SET NAMES UTF8";
mysqli_query($conexion, $consulta);

$page = $_POST['page'];
$min = $page * 10;
$consulta = "SELECT * FROM notificacion ORDER BY fecha_emision DESC LIMIT $min, 10";
$result = mysqli_query($conexion, $consulta);
$arr = array();
while($row = mysqli_fetch_assoc($result)){

  array_push($arr, $row);
}

echo json_encode($arr);


$conexion->close();

?>
