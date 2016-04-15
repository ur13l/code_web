<?
$correo = $_login["correo"];
$pass = $__login["password"];

$conexion = mysql_connect("localhost","root","10.0.7.48");
mysql_select_db("code_web",$conexion);

$sql  = "SELECT id FROM login WHERE correo='$correo' AND password='$pass'";
$comprobar = mysql_query($sql);

if(mysql_num_rows($comprobar) > 0) {
  $id = mysql_result($comprobar,0);
  header("Location:login.php");
}
else
  echo "Correo o Contraseña incorrecta";
?>
