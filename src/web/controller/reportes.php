<?php
#Autor: Uriel Infante
#Controlador que devuelve la tabla que será reporteada en CSV
#Fecha: 05/07/2016

include("../../app_php/conexion/conexion.php");


$conexion = connect();

$consulta = "SET NAMES UTF8";
mysqli_query($conexion, $consulta);


$consulta = "SELECT * FROM notificacion ORDER BY fecha_emision DESC LIMIT $min, 10";
$result = mysqli_query($conexion, $consulta);
$arr = array();
while($row = mysqli_fetch_assoc($result)){

  array_push($arr, $row);
}

echo json_encode($arr);


$conexion->close();
SELECT  @n := @n + 1, la.id_login_app, la.facebook, la.google, dp.fec_nacimiento, dp.codigo_postal, g.nombre as genero, o.nombre as ocupacion,
dcp.peso_actual, dcp.estatura_actual, dcp.presion_elevada, dcp.glucosa_elevada, dcp.actividad_fisica, ea.descripcion as estado_animo FROM (select @n:=0) initvars,
login_app la, datos_perfil dp, genero g, ocupacion o, datos_complementarios_perfil dcp, estado_animo ea WHERE
la.id_login_app = dp.id_login_app AND la.id_login_app = dcp.id_login_app AND dcp.id_estado_animo = ea.id_estado_animo

?>
