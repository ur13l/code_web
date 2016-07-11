<?php
#Autor: Uriel Infante
#Controlador de los eventos, CRUD de usuarios en la base de datos.
#Fecha: 07/07/2016

include("../../app_php/conexion/conexion.php");
$conexion = connect();
$action = $_POST['action'];

$consulta = "SET NAMES UTF8";
mysqli_query($conexion, $consulta);

switch($action){
  case 'create':
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $consulta = "INSERT INTO login VALUES (0,'$correo', MD5('$password'), 1)";
    mysqli_query($conexion, $consulta);
    echo '{"success":"true"}';
    break;
  case 'update':
    $id = $_POST['id'];
    $password = $_POST['password'];
    $consulta = "UPDATE login SET password=MD5('$password') WHERE id = '$id'";
    mysqli_query($conexion, $consulta);
    echo '{"success":"true"}';
  break;
  case 'read':
    $page = $_POST['page'];
    $min = $page * 10;
    $consulta = "SELECT * FROM login WHERE estado = 1 ORDER BY
      id LIMIT $min, 10";
    $result = mysqli_query($conexion, $consulta);
    $arr = array();
    while($row = mysqli_fetch_assoc($result)){
      array_push($arr, $row);
    }
    echo json_encode($arr);
  break;
  case 'count':
    $consulta = "SELECT COUNT(id) as pages FROM login WHERE estado=1";
    $result = mysqli_query($conexion, $consulta);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
    break;
  case 'delete':
    $ids = json_decode($_POST['ids']);
    for($i = 0 ; $i < count($ids) ; $i++){
      $consulta = "UPDATE login SET estado=0 WHERE id = '".$ids[$i]."'";
      $result = mysqli_query($conexion, $consulta);
    }
    echo '{"success":"true"}';
    break;
}
$conexion->close();

 ?>
