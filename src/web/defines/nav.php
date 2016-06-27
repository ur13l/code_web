<!--
Autor: Felipe Uriel Infante Martínez
Script que devuelve el template del encabezado mostrado en la interfaz web.
Fecha: 01/05/16
-->

<?php
echo '<nav>
  <div class="nav-wrapper blue-code">
    <a href="#" class="brand-logo">&nbspActívate CODE</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

    <ul class="right hide-on-med-and-down">
        <li><a href="notificaciones.php">Notificaciones</a></li>
      <li><a href="eventos.php">Eventos</a></li>
      <li><a href="video.php">Video</a></li>
      <li><a href="../../logout.php">Cerrar sesión</a></li>
    </ul>
    <ul class="side-nav" id="mobile-demo">
        <li><a href="notificaciones.php">Notificaciones</a></li>
        <li><a href="eventos.php">Eventos</a></li>
        <li><a href="video.php">Video</a></li>
        <li><a href="../../logout.php">Cerrar sesión</a></li>
   </ul>
  </div>
</nav>
'

 ?>
