<?php
  #Autor: Uriel Infante
  #Script para registrar el token de un dispositivo para el envío de las notificaciones.
  #Fecha: 07/06/2016

  include("../conexion/conexion.php");
  $conexion = connect();
   $token = $_POST['Token'];
   $id_login_app = $_POST['id_login_app'];
   $os = $_POST['os'];
   $query = "DELETE FROM login_token WHERE token = '$token' OR id_login_app = '$id_login_app';";
  mysqli_query($conexion, $query);
   $query = "INSERT INTO login_token VALUES ('$id_login_app','$token', '$os') ON
       DUPLICATE KEY UPDATE token = '$token', os = '$os';";
  mysqli_query($conexion, $query);
  $conexion->close();

?>
