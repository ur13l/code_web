<?php
#Autor: Uriel Infante
#Controlador de los eventos, CRUD de eventos en la base de datos..
#Fecha: 15/05/2016
include("../../app_php/conexion/conexion.php");
$conexion = connect();
$action = $_POST['action'];

$consulta = "SET NAMES UTF8";
mysqli_query($conexion, $consulta);

switch($action){
  case 'create':
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $tipo = $_POST['tipo'];
    $consulta = "INSERT INTO evento VALUES (0,'$titulo', '$descripcion', '$fechaInicio', '$fechaFin', '$tipo', now())";
    mysqli_query($conexion, $consulta);
    echo '{"success":"true"}';
    break;
  case 'update':
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $tipo = $_POST['tipo'];
    $consulta = "UPDATE evento SET titulo='$titulo', descripcion='$descripcion', fecha_inicio='$fechaInicio', fecha_fin='$fechaFin', tipo='$tipo', fecha_actualizacion=now()
              WHERE id_evento = '$id'";
    mysqli_query($conexion, $consulta);
    echo '{"success":"true"}';
  break;
  case 'read':
  $page = $_POST['page'];
  $consulta = "SELECT * FROM evento ORDER BY fecha_actualizacion DESC";
  $result = mysqli_query($conexion, $consulta);
  //echo json_encode()
    /*echo "
    <a href='#' class='item-evento'>
    <tr  class='item-evento'>
    <input type='hidden' value='".$row['id_evento']."'>
    <td>".$row['titulo'] ."</td>
    <td>".$row['descripcion'] ."</td>
    <td>".$row['fecha_inicio'] ."</td>
    <td>".$row['fecha_fin'] ."</td>
    <td>".$row['tipo'] ."</td>
    </tr>
    </a>
    ";
    */
  break;
}
$conexion->close();

 ?>
