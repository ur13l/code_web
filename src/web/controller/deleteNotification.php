<?php
#Autor: Uriel Infante
#Eliminar notificaciones del registro.
#Fecha: 13/06/2016

include("../../app_php/conexion/conexion.php");


$conexion = connect();

$consulta = "SET NAMES UTF8";
mysqli_query($conexion, $consulta);

$ids = json_decode($_POST['ids']);
for($i = 0 ; $i < count($ids) ; $i++){
  $consulta = "DELETE FROM notificacion WHERE id_notificacion = '".$ids[$i]."'";
  $result = mysqli_query($conexion, $consulta);
}
echo '{"success":"true"}';
$conexion->close();

?>
