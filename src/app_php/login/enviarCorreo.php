<?php
#Autor: Uriel Infante
#Script para cambiar la contraseña de un nuevo usuario.
#Recibe mediante POST el parámetro correo y la nueva contraseña.
#Fecha: 27/04/2016


function enviar($para, $codigo){
  ini_set('display_errors', 1);
  require 'phpmailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;
  $mail->IsSMTP(); // enable SMTP
  $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true; // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465; // or 587
  $mail->IsHTML(true);
  $mail->Username = 'celdesitl@gmail.com';
  $mail->Password = '123asdZXC';
  $mail->SetFrom('celdesitl@gmail.com');
  $mail->CharSet = 'UTF-8';
  $mail->Subject = 'Código para reestablecer contraseña';
  $mail->Body = '
  <!-- Inliner Build Version 4380b7741bb759d6cb997545f3add21ad48f010b -->
<!DOCTYPE html>
<html style="min-height: 100%; background: #f3f3f3;">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
</head>
<body style="width: 100% !important; min-width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0; padding: 0;">
<style type="text/css">
@media only screen and (max-width: 596px) {
  .small-float-center {
    margin: 0 auto !important; float: none !important; text-align: center !important;
  }
  .small-text-center {
    text-align: center !important;
  }
  .small-text-left {
    text-align: left !important;
  }
  .small-text-right {
    text-align: right !important;
  }
  table.body table.container .hide-for-large {
    display: block !important; width: auto !important; overflow: visible !important;
  }
  table.body table.container .row.hide-for-large {
    display: table !important; width: 100% !important;
  }
  table.body table.container .row.hide-for-large {
    display: table !important; width: 100% !important;
  }
  table.body table.container .show-for-large {
    display: none !important; width: 0; mso-hide: all; overflow: hidden;
  }
  table.body img {
    width: auto !important; height: auto !important;
  }
  table.body center {
    min-width: 0 !important;
  }
  table.body .container {
    width: 95% !important;
  }
  table.body .columns {
    height: auto !important; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; padding-left: 16px !important; padding-right: 16px !important;
  }
  table.body .column {
    height: auto !important; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; padding-left: 16px !important; padding-right: 16px !important;
  }
  table.body .columns .column {
    padding-left: 0 !important; padding-right: 0 !important;
  }
  table.body .columns .columns {
    padding-left: 0 !important; padding-right: 0 !important;
  }
  table.body .column .column {
    padding-left: 0 !important; padding-right: 0 !important;
  }
  table.body .column .columns {
    padding-left: 0 !important; padding-right: 0 !important;
  }
  table.body .collapse .columns {
    padding-left: 0 !important; padding-right: 0 !important;
  }
  table.body .collapse .column {
    padding-left: 0 !important; padding-right: 0 !important;
  }
  td.small-1 {
    display: inline-block !important; width: 8.33333% !important;
  }
  th.small-1 {
    display: inline-block !important; width: 8.33333% !important;
  }
  td.small-2 {
    display: inline-block !important; width: 16.66667% !important;
  }
  th.small-2 {
    display: inline-block !important; width: 16.66667% !important;
  }
  td.small-3 {
    display: inline-block !important; width: 25% !important;
  }
  th.small-3 {
    display: inline-block !important; width: 25% !important;
  }
  td.small-4 {
    display: inline-block !important; width: 33.33333% !important;
  }
  th.small-4 {
    display: inline-block !important; width: 33.33333% !important;
  }
  td.small-5 {
    display: inline-block !important; width: 41.66667% !important;
  }
  th.small-5 {
    display: inline-block !important; width: 41.66667% !important;
  }
  td.small-6 {
    display: inline-block !important; width: 50% !important;
  }
  th.small-6 {
    display: inline-block !important; width: 50% !important;
  }
  td.small-7 {
    display: inline-block !important; width: 58.33333% !important;
  }
  th.small-7 {
    display: inline-block !important; width: 58.33333% !important;
  }
  td.small-8 {
    display: inline-block !important; width: 66.66667% !important;
  }
  th.small-8 {
    display: inline-block !important; width: 66.66667% !important;
  }
  td.small-9 {
    display: inline-block !important; width: 75% !important;
  }
  th.small-9 {
    display: inline-block !important; width: 75% !important;
  }
  td.small-10 {
    display: inline-block !important; width: 83.33333% !important;
  }
  th.small-10 {
    display: inline-block !important; width: 83.33333% !important;
  }
  td.small-11 {
    display: inline-block !important; width: 91.66667% !important;
  }
  th.small-11 {
    display: inline-block !important; width: 91.66667% !important;
  }
  td.small-12 {
    display: inline-block !important; width: 100% !important;
  }
  th.small-12 {
    display: inline-block !important; width: 100% !important;
  }
  .columns td.small-12 {
    display: block !important; width: 100% !important;
  }
  .column td.small-12 {
    display: block !important; width: 100% !important;
  }
  .columns th.small-12 {
    display: block !important; width: 100% !important;
  }
  .column th.small-12 {
    display: block !important; width: 100% !important;
  }
  table.body td.small-offset-1 {
    margin-left: 8.33333% !important;
  }
  table.body th.small-offset-1 {
    margin-left: 8.33333% !important;
  }
  table.body td.small-offset-2 {
    margin-left: 16.66667% !important;
  }
  table.body th.small-offset-2 {
    margin-left: 16.66667% !important;
  }
  table.body td.small-offset-3 {
    margin-left: 25% !important;
  }
  table.body th.small-offset-3 {
    margin-left: 25% !important;
  }
  table.body td.small-offset-4 {
    margin-left: 33.33333% !important;
  }
  table.body th.small-offset-4 {
    margin-left: 33.33333% !important;
  }
  table.body td.small-offset-5 {
    margin-left: 41.66667% !important;
  }
  table.body th.small-offset-5 {
    margin-left: 41.66667% !important;
  }
  table.body td.small-offset-6 {
    margin-left: 50% !important;
  }
  table.body th.small-offset-6 {
    margin-left: 50% !important;
  }
  table.body td.small-offset-7 {
    margin-left: 58.33333% !important;
  }
  table.body th.small-offset-7 {
    margin-left: 58.33333% !important;
  }
  table.body td.small-offset-8 {
    margin-left: 66.66667% !important;
  }
  table.body th.small-offset-8 {
    margin-left: 66.66667% !important;
  }
  table.body td.small-offset-9 {
    margin-left: 75% !important;
  }
  table.body th.small-offset-9 {
    margin-left: 75% !important;
  }
  table.body td.small-offset-10 {
    margin-left: 83.33333% !important;
  }
  table.body th.small-offset-10 {
    margin-left: 83.33333% !important;
  }
  table.body td.small-offset-11 {
    margin-left: 91.66667% !important;
  }
  table.body th.small-offset-11 {
    margin-left: 91.66667% !important;
  }
  table.body table.columns td.expander {
    display: none !important;
  }
  table.body table.columns th.expander {
    display: none !important;
  }
  table.body .right-text-pad {
    padding-left: 10px !important;
  }
  table.body .text-pad-right {
    padding-left: 10px !important;
  }
  table.body .left-text-pad {
    padding-right: 10px !important;
  }
  table.body .text-pad-left {
    padding-right: 10px !important;
  }
  table.menu {
    width: 100% !important;
  }
  table.menu td {
    width: auto !important; display: inline-block !important;
  }
  table.menu th {
    width: auto !important; display: inline-block !important;
  }
  table.menu.vertical td {
    display: block !important;
  }
  table.menu.vertical th {
    display: block !important;
  }
  table.menu.small-vertical td {
    display: block !important;
  }
  table.menu.small-vertical th {
    display: block !important;
  }
  table.menu[align="center"] {
    width: auto !important;
  }
}
</style>
  <table class="body" data-made-with-foundation="" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; height: 100%; width: 100%; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; background: #f3f3f3; margin: 0; padding: 0;" bgcolor="#f3f3f3"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td class="float-center" align="center" valign="top" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; float: none; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0 auto; padding: 0;">
  <center data-parsed="" style="width: 100%; min-width: 580px;">
  <table class="wrapper header float-center" align="center" style="width: 100%; border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: center; float: none; background: #8a8a8a; margin: 0 auto; padding: 0;" bgcolor="#8a8a8a"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td class="wrapper-inner" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 20px;" align="left" valign="top">

  </td>
  </tr></table>
<table class="container float-center" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: center; width: 580px; float: none; background: #fefefe; margin: 0 auto; padding: 0;" bgcolor="#fefefe"><tbody><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top">
  <table class="spacer" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; padding: 0;"><tbody><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td height="16px" style="font-size: 16px; line-height: 16px; word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; margin: 0; padding: 0;" align="left" valign="top"> </td>
  </tr></tbody></table>
<table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: table; padding: 0;"><tbody><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<th class="small-12 large-12 columns first last" style="width: 564px; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0 auto; padding: 0 16px 16px;" align="left">
  <table style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<th style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left">
  <h1 style="color: inherit; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 1.3; word-wrap: normal; font-size: 34px; margin: 0 0 10px; padding: 0;" align="left">¡Hola!</h1>
  <p class="lead" style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 1.6; font-size: 20px; margin: 0 0 10px; padding: 0;" align="left">Has realizado la solicitud para un cambio de contraseña para el usuario '.$para.'</p>
  <p style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0 0 10px; padding: 0;" align="left">Para proceder al cambio de contraseña deberás ingresar a la aplicación de <b>Actívate CODE</b> e
    introducir el siguiente código de acceso.</p>
  <table class="callout" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; margin-bottom: 16px; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<th class="callout-inner primary" style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; width: 100%; background: #def0fc; margin: 0; padding: 10px; border: 1px solid #444444;" align="left" bgcolor="#def0fc">
  <p style="font-size: 40px; text-align: center; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; margin: 0 0 10px; padding: 0;" align="center"><b>'.$codigo.'</b> </p>
  </th>
  <th class="expander" style="visibility: hidden; width: 0; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left"></th>
  </tr></table>
</th>
  <th class="expander" style="visibility: hidden; width: 0; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left"></th>
  </tr></table>
</th>
  </tr></tbody></table>
<table class="wrapper secondary" align="center" style="width: 100%; border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; background: #f3f3f3; padding: 0;" bgcolor="#f3f3f3"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td class="wrapper-inner" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top">
  <table class="spacer" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; padding: 0;"><tbody><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td height="16px" style="font-size: 16px; line-height: 16px; word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; margin: 0; padding: 0;" align="left" valign="top"> </td>
  </tr></tbody></table>
<table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: table; padding: 0;"><tbody><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<th class="small-12 large-6 columns first" style="width: 274px; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0 auto; padding: 0 8px 16px 16px;" align="left">
  <table style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<th style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left">
  <h5 style="color: inherit; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 1.3; word-wrap: normal; font-size: 20px; margin: 0 0 10px; padding: 0;" align="left">Conéctate con nosotros:</h5>
  <table class="button facebook expand" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100% !important; margin: 0 0 16px; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top">
  <table style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #fefefe; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; background-color: #3B5998 !important; margin: 0; padding: 0; border: 2px solid #3b5998;" align="left" bgcolor="#3B5998 !important" valign="top">
  <center data-parsed="" style="width: 100%; min-width: 0;"><a href="https://www.facebook.com/GuanajuatoCODE/" align="center" class="float-center" style="color: #fefefe; font-family: Helvetica,Arial,sans-serif; font-weight: bold; text-align: center; line-height: 1.3; text-decoration: none; font-size: 16px; display: inline-block; border-radius: 3px; width: 100%; margin: 0; padding: 8px 0; border: 0px solid #2199e8;">Facebook</a></center>
  </td>
  </tr></table>
</td>
  <td class="expander" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top"></td>
  </tr></table>
<table class="button twitter expand" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100% !important; margin: 0 0 16px; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top">
  <table style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #fefefe; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; background-color: #1daced !important; margin: 0; padding: 0; border: 2px solid #1daced;" align="left" bgcolor="#1daced !important" valign="top">
  <center data-parsed="" style="width: 100%; min-width: 0;"><a href="https://twitter.com/guanajuatocode?lang=es" align="center" class="float-center" style="color: #fefefe; font-family: Helvetica,Arial,sans-serif; font-weight: bold; text-align: center; line-height: 1.3; text-decoration: none; font-size: 16px; display: inline-block; border-radius: 3px; width: 100%; margin: 0; padding: 8px 0; border: 0px solid #2199e8;">Twitter</a></center>
  </td>
  </tr></table>
</td>
  <td class="expander" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top"></td>
  </tr></table>
<table class="button google expand" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100% !important; margin: 0 0 16px; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top">
  <table style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<td style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #fefefe; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; background-color: #DB4A39 !important; margin: 0; padding: 0; border: 2px solid #db4a39;" align="left" bgcolor="#DB4A39 !important" valign="top">
  <center data-parsed="" style="width: 100%; min-width: 0;"><a href="http://www.codegto.gob.mx/" align="center" class="float-center" style="color: #fefefe; font-family: Helvetica,Arial,sans-serif; font-weight: bold; text-align: center; line-height: 1.3; text-decoration: none; font-size: 16px; display: inline-block; border-radius: 3px; width: 100%; margin: 0; padding: 8px 0; border: 0px solid #2199e8;">Sitio web</a></center>
  </td>
  </tr></table>
</td>
  <td class="expander" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top"></td>
  </tr></table>
</th>
  </tr></table>
</th>
  <th class="small-12 large-6 columns last" style="width: 274px; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0 auto; padding: 0 16px 16px 8px;" align="left">
  <table style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
<th style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left">
  <h5 style="color: inherit; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 1.3; word-wrap: normal; font-size: 20px; margin: 0 0 10px; padding: 0;" align="left">Estamos para servirte en:</h5>
  <p style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0 0 10px; padding: 0;" align="left">MACROCENTRO 1 </p>
  <p style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0 0 10px; padding: 0;" align="left">Carr. Gto-Dolores Hgo. Km. 1.5 Valenciana Guanajuato, Gto. </p>
  <p style="color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0 0 10px; padding: 0;" align="left">473 732 40 96 | sistemas.code@guanajuato.gob.mx</p>
  </th>
  </tr></table>
</th>
  </tr></tbody></table>
</td>
  </tr></table>
</td>
  </tr></tbody></table>
</center>
  </td>
  </tr></table>
</body>
</html>


  ';
  $mail->AddAddress($para);

   if(!$mail->Send()) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
   } else {
      //echo 'Message has been sent';
      return true;
   }
 }

?>
