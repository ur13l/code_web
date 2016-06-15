<?php
$correo = $_POST["correo"];
$pass = $_POST["password"];
include("app_php/conexion/conexion.php");
$conexion = connect();

$sql  = "SELECT id FROM login WHERE correo='$correo' AND password=MD5('$pass')";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($result);

if(isset($row)) {
  echo "BIEN";
  //
}
else{
  echo "Correo o Contraseña incorrecta";

}
?>
