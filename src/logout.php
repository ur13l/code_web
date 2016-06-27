<?php

session_start();
unset($_SESSION['usuario_correo']);
header("Location:index.html");

?>
