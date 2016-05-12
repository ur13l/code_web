<?php
  #Autor: Uriel Infante
  #Script que comprueba si un correo existe o no en la base de datos
  #Devuelve el texto "true" en caso de existir, "false" si no existe.
  #Parámetros: correo
  #Fecha: 04/05/2016

  include("../conexion/conexion.php");
  $conexion = connect();
  $correo = $_POST["correo"];

  $consulta = "SELECT id_login_app FROM login_app WHERE correo = '$correo'";

  $result = mysqli_query($conexion, $consulta);
  $row = mysqli_fetch_array($result);

  if(isset($row)){
    echo "true";
  }
  else if ($conexion){
    echo "false";
  }

  $conexion->close();
?>
