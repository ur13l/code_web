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
  $peso = $_POST["peso"];
  $estatura = $_POST["estatura"];


  $q1 = $_POST["nombre"] != '' ? "nombre = '$nombre'": "nombre = null";
  $q2 = $_POST["genero"] != '' ? "id_genero = '$genero'": "id_genero = null";
  $q3 = $_POST["fec_nacimiento"] != '' ? "fec_nacimiento = '$fec_nacimiento'": "fec_nacimiento = null";
  $q4 = $_POST["ocupacion"] != '' ? "id_ocupacion = '$ocupacion'": "id_ocupacion = null";
  $q5 = $_POST["codigo_postal"] != '' ? "codigo_postal = '$codigo_postal'": "codigo_postal = null";
  $q6 = $_POST["telefono"] != '' ? "telefono = '$telefono'": "telefono = null";
  $q7 = $_POST["peso"] != '' ? "peso_actual = '$peso'": "peso_actual = null";
  $q8 = $_POST["telefono"] != '' ? "estatura_actual = '$estatura'": "estatura_actual = null";

  //Se verifica que exista un registro del usuario en la tabla.
  $consulta = "SELECT id_login_app FROM datos_perfil WHERE id_login_app = '$id_login_app'";

  $result = mysqli_query($conexion, $consulta);
  $id = mysqli_fetch_row($result)[0];

  //Si el usuario ya existe se hace un UPDATE.
  if(isset($id)){
    $consulta = "UPDATE datos_perfil SET $q1, $q2, $q3, $q4, $q5, $q6 WHERE id_login_app = '$id'";

    $result = mysqli_query($conexion, $consulta);
    if($result){
      $consulta = "UPDATE datos_complementarios_perfil SET $q7, $q8 WHERE id_login_app = '$id'";
      $result = mysqli_query($conexion, $consulta);
      if($result){
        echo "success";
      }
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
