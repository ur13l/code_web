<?php
#Autor: Uriel Infante
#Controlador de las notificaciones, se registran nuevas notificaciones.
#Fecha: 12/06/2016

include("../../app_php/conexion/conexion.php");
include("../../app_php/notificaciones/pushNotification.php");


$conexion = connect();
$action = $_POST['action'];

$consulta = "SET NAMES UTF8";
$titulo = $_POST['titulo'];
$mensaje = $_POST['mensaje'];
$enlace = $_POST['enlace'];
$schedule = $_POST['schedule'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$hombre = $_POST['hombre'];
$mujer = $_POST['mujer'];
$presion = $_POST['presion'];
$glucosa = $_POST['glucosa'];
$rango = $_POST['rango'];
$age1 = $_POST['age1'];
$age2 = $_POST['age2'];
$android = $_POST['android'];
$ios = $_POST['ios'];

$where = "";

if($hombre != "true"){
  $where .= "AND dp.id_genero != 1 ";
}
if($mujer != "true"){
  $where .= "AND dp.id_genero != 2 ";
}
if($presion != "true"){
  $where .= "AND dcp.presion_elevada != 1 ";
}
if($glucosa != "true"){
  $where .= "AND dcp.glucosa_elevada != 1 ";
}
if($rango == 2){
  $where .= "AND dp.fec_nacimiento < DATE_ADD(now(), INTERVAL -$age1 YEAR)
      AND dp.fec_nacimiento > DATE_ADD(now(), INTERVAL -$age2 YEAR) ";
}
if($rango == 3){
  $where .= "AND dp.fec_nacimiento < DATE_ADD(now(), INTERVAL -$age1 YEAR) ";
}
if($rango == 4){
  $where .= "AND dp.fec_nacimiento > DATE_ADD(now(), INTERVAL -$age1 YEAR) ";
}
if($android != "true"){
  $where .= "AND lt.os != 1 ";
}
if($ios != "true"){
  $where .= "AND lt.os != 2 ";
}


$consulta = "SET NAMES UTF8";
mysqli_query($conexion, $consulta);

$query = "SELECT lt.token FROM login_token lt, datos_perfil dp, datos_complementarios_perfil dcp WHERE lt.id_login_app = dp.id_login_app
AND dp.id_login_app = dcp.id_login_app AND lt.id_login_app = dcp.id_login_app " . $where;

$result = mysqli_query($conexion, $query);
$tokens = array();

if (mysqli_num_rows($result) > 0){
   while ($row = mysqli_fetch_array($result)){
      $tokens[] = $row["token"];
   }
}

/*
$message = array(
 "title" => $titulo,
 "message" => $mensaje,
 "link" => $enlace,

 );
*
/*
$message = array(
 "alert" => $titulo,
  "sound" => 'default',
 "link_url" => $url,
 "category" => "URL_CATEGORY" );
*/

$message = array(
   'title' => $titulo,
                    'body' => $mensaje,
                    'link_url' => $enlace,
                    'sound' => 'default',
                    'category' => 'URL_CATEGORY',
		'tag' => $enlace);

 $message_status = sendNotification($tokens, $message);
 if(isset($message_status)){
   $success = array("success" => "true");
   $query = "INSERT INTO notificacion VALUES (0, '$titulo', '$mensaje', now())";
   $result = mysqli_query($conexion, $query);
   echo json_encode($success);
 }
 $conexion->close();

?>
