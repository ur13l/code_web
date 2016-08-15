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
  <title>Video</title>
  <link rel="stylesheet" href="../../materialize/css/materialize.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/lolliclock.css">
  <link rel="stylesheet" href="../../css/toastr.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" src="../../js/jquery-1.12.3.js"></script>
  <script type="text/javascript" src="../../materialize/js/materialize.js"></script>
  <script type="text/javascript" src="../../js/video.js"> </script>

</head>
<body style="background:#f1f1f1">
  <?php
  include("../defines/nav.php");
  include('../defines/checkLogin.php');
  ?>
  <div class="container" style="background:white;  padding:30px; margin-top:50px">
    <div class="row">
      <img src="../../img/code.png" class="col s9 m6 l3 offset-s2 offset-m3 offset-l4">
    </div>
    <div class="row">
        <h5>Video de activación actual</h5>

				<video style="width: 70%; margin-left:15%" controls autoplay>
				  <source src="../../res/video/video.mp4" type="video/mp4">
				Your browser does not support the video tag.
				</video>
				<form id="upload_form" enctype="multipart/form-data" method="post">

					<div class="row">

					<div class="file-field input-field class col s5 offset-s3">
					      <div class="btn green-code">
					        <span>Examinar</span>
					        <input type="file" value="EXAMINAR"  name="file1" id="file1">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					      </div>
					    </div>

						</div>
							<a class="waves-effect green-code waves-light btn col s3 offset-s4" onclick="uploadFile()"><i class="material-icons left">cloud</i>Subir video</a>

							</div>
							<div class="progress">
					      <div class="determinate" style="width: 0%"></div>
					  </div>

				</form>

      </div>


  </div>

</body>
</html>
