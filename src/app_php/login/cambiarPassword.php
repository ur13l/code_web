<?php
#Autor: Uriel Infante
#Script para cambiar la contraseña de un nuevo usuario.
#Recibe mediante POST el parámetro correo y la nueva contraseña.
#Fecha: 27/04/2016

include("../conexion/conexion.php");
$conexion = connect();
$correo = $_POST["correo"];
$password = $_POST["password"];
$consulta = "UPDATE login_app SET password = MD5('$password') WHERE correo = '$correo';";

if(!$result = mysqli_query($conexion, $consulta))
{
    echo "error";
    $conexion->close();
    exit();
}
else
{
    echo "success";
}

$conexion->close();

 ?>
