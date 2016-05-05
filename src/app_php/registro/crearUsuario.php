<?php
  #Autor: Uriel Infante
  #Script para registrar a un usuario.
  #Recibe: correo, contraseña y datos adicionales.
  #Fecha: 04/05/2016

  include("../conexion/conexion.php");
  $conexion = connect();
  $correo = $_POST["correo"];
  $password = $_POST["password"];
  $facebook = $_POST["facebook"];
  $google = $_POST["google"];
  $estatura = $_POST["estatura"];
  $peso = $_POST["peso"];
  $presion = $_POST["presion"];
  $glucosa = $_POST["glucosa"];
  $actividad = $_POST["actividad"];
  $animo = $_POST["animo"];



  $consulta = "CALL stp_registrar_usuario('$correo', '$password', '$facebook', '$google','$peso','$estatura','$presion','$glucosa','$actividad','$animo')";
  //Se hace la inserción en la tabla login_app
  $result = mysqli_query($conexion, $consulta);

  //Se consulta la clave del usuario.
  $consulta = "SELECT id_login_app FROM login_app WHERE correo = '$correo'";
  $result = mysqli_query($conexion, $consulta);
  $id = mysqli_fetch_row($result)[0];

  if(isset($id)){
    //Se hace la inserción en la tabla login_app
    echo "$id";

  }
  else{
    echo "0";
  }

?>
