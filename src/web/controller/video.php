<?php
#Autor: Uriel Infante
#Controlador para cargar el video de activación nuevo.
#Fecha: 20/06/2016
#

include("../../app_php/conexion/conexion.php");
$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
if(move_uploaded_file($fileTmpLoc, "../../res/video/video.mp4")){

  $conexion = connect();
  $consulta = "INSERT INTO video VALUES (1, now(), '$fileSize') ON
      DUPLICATE KEY UPDATE fecha_actualizacion = now(), tamano = '$fileSize'";
  mysqli_query($conexion, $consulta);
  $conexion->close();
  echo '{"success":"true"}';
} else {
    echo $fileTmpLoc;
    echo "move_uploaded_file function failed";
}
?>
J
