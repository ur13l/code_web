<?php
  #Autor: Uriel Infante
  #Script para traer los datos de perfil de un usuario de acuerdo a su id_login_app.
  #Fecha: 19/05/2016

  include("../conexion/conexion.php");
  $conexion = connect();
  $id_login_app = $_POST["id_login_app"];

  //Se traen los datos del perfil en un arreglo.
  $consulta = "SELECT * FROM datos_perfil WHERE id_login_app = '$id_login_app'";
  $result = mysqli_query($conexion, $consulta);
  $row = mysqli_fetch_array($result);

  //Si el usuario está asignado se envía el arreglo, si no existe
  if(isset($row)){
    $row['success'] = "true";
    echo json_encode($row);
  }
  //En caso de no existir .
  else {
    echo '{"succes" : "false"}';
  }
  $conexion->close();

?>
