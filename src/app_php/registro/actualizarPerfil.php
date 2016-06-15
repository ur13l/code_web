<?php
  #Autor: Uriel Infante
  #Script para insertar o actualizar los datos de perfil de un usuario
  #Recibe: nombre, género, fecha de nacimiento, ocupacion, codigo_postal y telefono.
  #Fecha: 11/05/2016

  include("../conexion/conexion.php");
  $conexion = connect();
  $id_login_app = $_POST["id_login_app"];
  $nombre = $_POST["nombre"];
  $genero = $_POST["genero"];
  $fec_nacimiento = $_POST["fec_nacimiento"];
  $ocupacion = $_POST["ocupacion"];
  $codigo_postal = $_POST["codigo_postal"];
  $telefono = $_POST["telefono"];

  //Se verifica que exista un registro del usuario en la tabla.
  $consulta = "SELECT id_login_app FROM datos_perfil WHERE id_login_app = '$id_login_app'";
  $result = mysqli_query($conexion, $consulta);
  $id = mysqli_fetch_row($result)[0];

  //Si el usuario ya existe se hace un UPDATE.
  if(isset($id)){
    $consulta = "UPDATE datos_perfil SET nombre = '$nombre', id_genero = '$genero',
        fec_nacimiento = '$fec_nacimiento', id_ocupacion = '$ocupacion',
        codigo_postal = '$codigo_postal', telefono = '$telefono' WHERE id_login_app = '$id'";
    $result = mysqli_query($conexion, $consulta);
    if($result){
      echo "success";
    }
  }
  //En caso de no existir se realiza el INSERT.
  else {
    $consulta = "INSERT INTO datos_perfil VALUES('$id_login_app', '$nombre', '$genero', '$fec_nacimiento', '$ocupacion', '$codigo_postal', '$telefono')";
    $result = mysqli_query($conexion, $consulta);
    if($result){
      echo "success";
    }
  }
  $conexion->close();

?>
