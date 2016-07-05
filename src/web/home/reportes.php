<?php
session_start();
if (isset($_SESSION['usuario_correo'])) {
  $correo = $_SESSION['usuario_correo'];
} else {
  header("Locationheader:../../index.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reporte de usuarios</title>
  <link rel="stylesheet" href="../../materialize/css/materialize.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/lolliclock.css">
  <link rel="stylesheet" href="../../css/toastr.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" src="../../js/jquery-1.12.3.js"></script>
  <script type="text/javascript" src="../../js/lolliclock.js"></script>
  <script type="text/javascript" src="../../materialize/js/materialize.js"></script>
  <script type="text/javascript" src="../../js/moment.js"></script>
  <script type="text/javascript" src="../../js/toastr.min.js"></script>
  <script type="text/javascript" src="../../js/jquery.twbsPagination.min.js"></script>
  <script type="text/javascript" src="../../js/notificaciones.js"> </script>

</head>
<body style="background:#f1f1f1">
  <?php
  include("../defines/nav.php");
  ?>
  <div class="container" style="background:white;  padding:30px; margin-top:50px">

        <a class="waves-effect waves-light btn green-code" id="enviar"><i class="material-icons left">send</i>Enviar</a>


  </div>

</body>
</html>
