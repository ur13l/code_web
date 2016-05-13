<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../materialize/css/materialize.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="../../js/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="../../materialize/js/materialize.js"></script>
    <script type="text/javascript">
   $(document).ready(function(){
      $(".button-collapse").sideNav();
     console.log("NO");
   });
 </script>
    <?php
      session_start();
      if (isset($_SESSION['usuario_correo'])) {
        $correo = $_SESSION['usuario_correo'];
      } else {
        echo "No hay usuario";
      }
     ?>
</head>
<body>
  <?php
    include("../defines/nav.php");
   ?>
<div class="container">
  <div class="row">
    <table>
            <thead>
              <tr>
                  <th data-field="titulo">Título</th>
                  <th data-field="descripcion">Descripción</th>
                  <th data-field="fecha_inicio">Inicia</th>
                  <th data-field="fecha_fin">Termina</th>
                  <th data-field="tipo">Tipo</th>

              </tr>
            </thead>

            <tbody>
              <?php
                include("../../app_php/conexion/conexion.php");
                $conexion = connect();
                $consulta = "SET NAMES UTF8";
                mysqli_query($conexion, $consulta);

                $consulta = "SELECT * FROM evento";
                $result = mysqli_query($conexion, $consulta);


                while ($row = mysqli_fetch_array($result)){
                  echo "
                  <tr>
                    <td><input type='text' value='".$row['titulo'] ."'</td>
                    <td><input type='text' value='".$row['descripcion'] ."'</td>
                    <td><input type='text' value='".$row['fecha_inicio'] ."'</td>
                    <td><input type='text' value='".$row['fecha_fin'] ."'</td>
                    <td><input type='text' value='".$row['tipo'] ."'</td>
                  </tr>
                  ";
                }
                $conexion->close();

              ?>
            </tbody>
          </table>
   </div>
    <a class="btn-floating btn-large waves-effect waves-light red right"><i class="material-icons">add</i></a>
 </div>
</body>
</html>
