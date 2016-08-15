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

</head>
<body style="background:#f1f1f1">
  <?php
  include("../defines/nav.php");
  ?>
  <div class="container" style="background:white;  padding:30px; margin-top:50px">
    <div class="row">
      <img src="../../img/code.png" class="col s9 m6 l3 offset-s2 offset-m3 offset-l4">
    </div>
<h1>Reportes</h1>

<ul>
  <li>
    <form class="" action="../controller/reportes.php" method="post">
      <div class="row">
        <h5 class="col s9" style="display:inline">Reporte de usuarios global</h5>

          <input type="submit" name="export_excel" class="waves-effect waves-light btn green-code col s3" value="Descargar Reporte">
      </div>

    </form></li>
</ul>



  </div>

</body>
</html>
