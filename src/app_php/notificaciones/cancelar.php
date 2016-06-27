<?php
  #Autor: Uriel Infante
  #Script para eliminar el token de un dispositivo para el envío de las notificaciones.
  #Fecha: 27/06/2016

  include("../conexion/conexion.php");
  $conexion = connect();
   $id_login_app = $_POST['id_login_app'];
   $os = $_POST['os'];
   $query = "DELETE FROM login_token WHERE id_login_app = '$id_login_app';";
  mysqli_query($conexion, $query);
  $conexion->close();

?>
