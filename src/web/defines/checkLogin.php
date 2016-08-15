<!--
Autor: Felipe Uriel Infante Martínez
Script que verifica el inicio de sesión, de no encontrarlo activo, envía a login.
Fecha: 27/06/16
-->

<?php
  session_start();
  if (isset($_SESSION['usuario_correo'])) {
    $correo = $_SESSION['usuario_correo'];
  } else {
    header('Location: ../../index.html');
  }
 ?>
