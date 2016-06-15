<?php
#Autor: Uriel Infante
#Controlador para traer el número de páginas necesarias.
#Fecha: 13/06/2016

include("../../app_php/conexion/conexion.php");


$conexion = connect();

$consulta = "SELECT COUNT(id_notificacion) as pages FROM notificacion";
$result = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_array($result);
echo json_encode($row);


$conexion->close();

?>
