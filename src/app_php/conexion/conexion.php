<?php

#Autor: Uriel Infante
#Archivo de conexión para el servidor de base de datos.
#Todos los archivos que conecten a la base de datos deben hacer referencia
#Fecha: 16/04/2016

/**
 * Función que revisa la conexión
 * @return conexion: Devuelve la conexión para utilizarse en otro ámbito.
 */
function connect(){

	$user = "YOUR_USER";
	$password = "YOUR_PASSWORD";
	$dbname = "DB_NAME";
	$port = 3306;
	$host = "HOST_IP"; //Ip Externa
	
// Create connection
	$conn = mysqli_connect($host, $user, $password, $dbname);
	// Check connection
	if (!$conn) {
	    echo "Connection failed: " . mysqli_connect_error();
	}
	return $conn;
}

?>
