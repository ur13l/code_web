<?php
  #Autor: Uriel Infante
  #Script para registrar el token de un dispositivo para el envío de las notificaciones.
  #Fecha: 07/06/2016

  include("../conexion/conexion.php");
  $conexion = connect();
   $token = $_POST['Token'];
   $id_login_app = $_POST['id_login_app'];
   $query = "INSERT INTO login_token VALUES ('$id_login_app','$token') ON
       DUPLICATE KEY UPDATE token = '$token';";
  mysqli_query($conexion, $query);
  $conexion->close();

?>
