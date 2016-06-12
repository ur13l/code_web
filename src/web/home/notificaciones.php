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
  <title>Notificaciones</title>
  <link rel="stylesheet" href="../../materialize/css/materialize.min.css">
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
    <div class="row">
      <img src="../../img/code.png" class="col s9 m6 l3 offset-s2 offset-m3 offset-l4">
    </div>
    <div class="row">
        <h5>Nueva notificación</h5>
        <div class="input-field col s12">
            <input placeholder="Título" id="titulo" type="text" class="validate">
            <label for="titulo">Título</label>
        </div>
        <div class="input-field col s12">
            <textarea id="mensaje" class="materialize-textarea"></textarea>
            <label for="mensaje">Mensaje</label>
      </div>
      </div>
      <!--
      <div class="row">
        <div class="input-field col s2">
          <input type="checkbox" id="chk_schedule" />
          <label for="chk_schedule">Programar</label>
        </div>
        <div class="input-field col s5">
          <input id="fecha" type="text" class="datepicker vald" disabled>
          <label for="fecha">Fecha</label>
        </div>
        <div class="input-field col s5">
          <input id="hora" type="text" class="timepicker vald" disabled>
          <label for="hora">Hora</label>
        </div>
      </div>
      -->
      <div class="row right">
        <a class="waves-effect waves-light btn modal-trigger " href="#modal1"><i class="material-icons left">settings</i>Configurar Destinatarios</a>
        <a class="waves-effect waves-light btn" id="enviar"><i class="material-icons left">send</i>Enviar</a>

      </div>



      <table class="highlight">
        <thead>
          <tr>
            <th data-field="check"></th>
            <th data-field="titulo">Título</th>
            <th data-field="descripcion">Descripción</th>
            <th data-field="fecha_inicio">Inicia</th>
            <th data-field="fecha_fin">Termina</th>
            <th data-field="editar">Editar</th>
            <th data-field="eliminar">Eliminar</th>

          </tr>
        </thead>

        <tbody id="tabla-eventos">

        </tbody>
      </table>
    </div>

<ul id="pagination-demo" class="pagination-sm"></ul>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
      <div class="modal-content">
        <h4>Personalizar destinatarios</h4>
        <p>
          <div class="row">
            <h6 class="col s12"> Por género </h6>
            <div class="input-field col s4">
              <input type="checkbox" id="chk_hombre" checked>
              <label for="chk_hombre">Hombres</label>
            </div>
            <div class="input-field col s4">
              <input type="checkbox" id="chk_mujer" checked>
              <label for="chk_mujer">Mujeres</label>
            </div>
          </div>
          <div class="row">
            <h6 class="col s12"> Condiciones especiales </h6>
            <div class="input-field col s4">
              <input type="checkbox" id="chk_presion" checked>
              <label for="chk_presion">Presión elevada</label>
            </div>
            <div class="input-field col s4">
              <input type="checkbox" id="chk_glucosa" checked>
              <label for="chk_glucosa">Glucosa elevada</label>
            </div>
          </div>
          <div class="row">
            <h6 class="col s12"> Por rango de edad </h6>
            <div class="input-field col s5">
              <select required id="sl_rango_edad" class="validate">
                <option value="" disabled>Elige una opción</option>
                <option value="1" selected>Todos</option>
                <option value="2">Entre</option>
                <option value="3">Mayores de </option>
                <option value="4">Menores de </option>
              </select>
            </div>

            <div class="input-field col s2">
              <input type="number" id="txt_age1" style="display:none" name="name" value="">
            </div>
            <div class="input-field col s2">
              <input type="number" id="txt_age2" style="display:none" name="name" value="">
            </div>
            <p class="col s2" id="label_age" style="display:none"> años </p>
          </div>
          <div class="row">
            <h6 class="col s12"> Sistema operativo </h6>
            <div class="input-field col s4">
              <input type="checkbox" id="chk_android" checked>
              <label for="chk_android">Android</label>
            </div>
            <div class="input-field col s4">
              <input type="checkbox" id="chk_ios" checked>
              <label for="chk_ios">iOS</label>
            </div>
          </div>
        </p>
      </div>
      <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
      </div>
    </div>

  </div>

</body>
</html>
