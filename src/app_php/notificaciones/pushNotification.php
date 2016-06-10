<?php

    function sendNotification($tokens, $message){
      $url = "https://fcm.googleapis.com/fcm/send";
      $fields = array(
        'registration_ids' => $tokens,
        'data' => $message,

      );
      $headers = array(
  			'Authorization:key = AIzaSyCP6sP-BhfEgXrQoNGxBWJW_EKxc6gD0ro ',
  			'Content-Type: application/json'
			);


	   $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
     $result = curl_exec($ch);
      if($result === FALSE){
        die('Curl failed ' . curl_error($ch));
      }

      curl_close($ch);

      return $result;

    }

    include("../conexion/conexion.php");
    $conexion = connect();
     $query = "SELECT token FROM login_token;";
     $result = mysqli_query($conexion, $query);
     $tokens = array();

     if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result)){
           $tokens[] = $row["token"];
        }
     }
    $conexion->close();


    $message = array(
      "message" => "La vida es un riesgo ese"
      );
      $message_status = sendNotification($tokens, $message);
      echo $message_status;
 ?>
