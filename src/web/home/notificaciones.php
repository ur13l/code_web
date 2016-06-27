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
    include('../defines/checkLogin.php');
  ?>
  <div class="container" style="background:white;  padding:30px; margin-top:50px">
    <div class="row">
      <img src="../../img/code.png" class="col s9 m6 l3 offset-s2 offset-m3 offset-l4">
    </div>
    <div class="row">
        <h5>Nueva notificación</h5>
        <div class="input-field col s12">
            <input placeholder="Título" id="titulo" type="text" maxlength="50" class="validate">
            <label for="titulo" data-error="Este campo es obligatorio">Título</label>
        </div>
        <div class="input-field col s12">
            <textarea id="mensaje" class="materialize-textarea " maxlength="2000"></textarea>
            <label for="mensaje" data-error="Este campo es obligatorio">Mensaje</label>
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
        <a class="waves-effect waves-light btn modal-trigger green-code" href="#modal1"><i class="material-icons left">settings</i>Configurar Destinatarios</a>
        <a class="waves-effect waves-light btn green-code" id="enviar"><i class="material-icons left">send</i>Enviar</a>

      </div>
      <div class="row" style="margin-top:110px">
      <h5 class="col s12">Notificaciones enviadas</h5>

      <table class="highlight">
        <thead>
          <tr>
            <th data-field="check"></th>
            <th data-field="titulo">Título</th>
            <th data-field="mensaje">Mensaje</th>
            <th data-field="fecha">Fecha</th>
            <th data-field="eliminar">Eliminar</th>

          </tr>
        </thead>

        <tbody id="tabla-notificaciones">

        </tbody>
      </table>
    </div>
    <ul id="pagination-demo" class="pagination-sm"></ul>
</div>

<div class="row">
    <!-- Modal Structure -->
    <div id="modal1" class="modal col s12 m8 l4 offset-m2 offset-l4">

      <div class="modal-content">
        <h4 class="blue-code-text">Personalizar destinatarios</h4>
        <p>
          <div class="row">
            <h6 class="col s12"> Por género </h6>
            <div class="input-field col s6">
              <input type="checkbox" id="chk_hombre" class="filled-in checkbox-green-code" checked>
              <label for="chk_hombre">Hombres</label>
            </div>
            <div class="input-field col s6">
              <input type="checkbox" id="chk_mujer" class="filled-in checkbox-green-code" checked>
              <label for="chk_mujer">Mujeres</label>
            </div>
          </div>
          <div class="row">
            <h6 class="col s12"> Condiciones especiales </h6>
            <div class="input-field col s6">
              <input type="checkbox" id="chk_presion" class="filled-in checkbox-green-code" checked>
              <label for="chk_presion">Presión elevada</label>
            </div>
            <div class="input-field col s6">
              <input type="checkbox" id="chk_glucosa" class="filled-in checkbox-green-code" checked>
              <label for="chk_glucosa">Glucosa elevada</label>
            </div>
          </div>
          <div class="row">
            <h6 class="col s12"> Por rango de edad </h6>
            <div class="input-field col s5">
              <select required id="sl_rango_edad" class="validate blue-code-text">
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
            <div class="input-field col s6">
              <input type="checkbox" id="chk_android" class="filled-in checkbox-green-code" checked>
              <label for="chk_android">Android</label>
            </div>
            <div class="input-field col s6">
              <input type="checkbox" id="chk_ios" class="filled-in checkbox-green-code" checked>
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
  <div id="deleteModal" class="modal">
      <div class="modal-content">
          <h4>Confirmar</h4>
          <p id="delete-message">¿Desea eliminar el evento seleccionado?</p>
      </div>
      <div class="modal-footer">
          <a href="#" class="waves-effect waves-green btn-flat" onclick="$('#deleteModal').closeModal(); return false;">Cancelar</a>
          <a href="#" class="waves-effect waves-green btn-flat" onclick="deleteNotifications()" id="md1_YesBtn">Sí</a>
     </div>
  </div>

  <div class="fixed-action-btn" id="delete-selection" style="display:none; bottom: 10px; right: 100px;">
    <a class="btn-floating btn-large waves-effect waves-light green-code btn" >
      <i class="material-icons" id="new-event">delete</i>
    </a>
  </div>
  </div>

</body>
</html>
