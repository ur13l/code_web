<?php
#Autor: Uriel Infante
#Controlador que devuelve la tabla que será reporteada en CSV
#Fecha: 05/07/2016
#
$connect = mysqli_connect("10.0.7.40", "root", "info2000", "code_web");
 $output = '';
 if(isset($_POST["export_excel"]))
 {
      $sql = "SELECT  @n := @n + 1 as num, la.id_login_app, la.facebook, la.google, dp.fec_nacimiento, dp.codigo_postal, g.nombre as genero, o.nombre as ocupacion,
dcp.peso_actual, dcp.estatura_actual, dcp.presion_elevada, dcp.glucosa_elevada, dcp.actividad_fisica, ea.descripcion as estado_animo FROM (select @n:=0) initvars,
login_app la, datos_perfil dp LEFT JOIN genero g ON dp.id_genero = g.id_genero LEFT JOIN ocupacion o ON dp.id_ocupacion = o.id_ocupacion, datos_complementarios_perfil dcp, estado_animo ea WHERE
la.id_login_app = dp.id_login_app AND la.id_login_app = dcp.id_login_app AND dcp.id_estado_animo = ea.id_estado_animo;";
      $result = mysqli_query($connect, $sql);
      if(mysqli_num_rows($result) > 0)
      {
           $output .= '
                <table class="table" bordered="1">
                     <tr>          ';
           $field = mysqli_num_fields($result);
while ($property = mysqli_fetch_field($result)) {
  //  echo $property->name;
    $output.= '<th>'.$property->name.' </th>';
}

$output .= '</tr>';
           while($row = mysqli_fetch_array($result))
           {
                $output .= '
                     <tr>
                          <td>'.$row["num"].'</td>
                          <td>'.$row["id_login_app"].'</td>
                          <td>'.$row["facebook"].'</td>
                          <td>'.$row["google"].'</td>
                          <td>'.$row["fec_nacimiento"].'</td>
                          <td>'.$row["codigo_postal"].'</td>
                          <td>'.$row["genero"].'</td>
                          <td>'.$row["ocupacion"].'</td>
                          <td>'.$row["peso_actual"].'</td>
                          <td>'.$row["estatura_actual"].'</td>
                          <td>'.$row["presion_elevada"].'</td>
                          <td>'.$row["glucosa_elevada"].'</td>
                          <td>'.$row["actividad_fisica"].'</td>
                          <td>'.$row["estado_animo"].'</td>
                     </tr>
                ';
           }
           $output .= '</table>';
           header("Content-Type: application/xls");
           header("Content-Disposition: attachment; filename=reporte_usuarios.xls");
           echo $output;
      }
 }
?>
