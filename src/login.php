<?php
$correo = $_POST["correo"];
$pass = $_POST["password"];
include("app_php/conexion/conexion.php");
$conexion = connect();
session_start();
$sql  = "SELECT id FROM login WHERE correo='$correo' AND password=MD5('$pass')";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($result);

if(isset($row)) {
  $_SESSION['usuario_correo'] = $correo;
  header("Location:web/home/eventos.php");
}
else{
  header("Location:indexError.html");

}
?>
