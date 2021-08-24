<?php 

	function connection (){
	// detalles de la conexion
	
	// establecemos una conexion con el servidor postgresSQL
	
	$host        = "host = ";
	$port        = "port = ";
	$dbname      = "dbname = ";
	$credentials = "user =  password = ";
	$options = "client_encoding = UTF8";
	// establecemos una conexion con el servidor postgresSQL
	$dbconn = pg_connect("$host $port $dbname $credentials $options");
	return $dbconn;

	}

	function connection185 (){
		// detalles de la conexion
		
		// establecemos una conexion con el servidor postgresSQL

		$host        = "host = ";
		$port        = "port = ";
		$dbname      = "dbname = ";
		$credentials = "user =  password = ";
		$options = "client_encoding = UTF8";
		// establecemos una conexion con el servidor postgresSQL
		$dbconn185 = pg_connect("$host $port $dbname $credentials $options");
		return $dbconn185;	

	}

	function connection181 (){
		$host        = "host = ";
		$port        = "port = ";
		$dbname      = "dbname = ";
		$credentials = "user =  password = ";
		$options = "client_encoding = UTF8";
		$dbconn = pg_connect("$host $port $dbname $credentials $options");
		return $dbconn;
	}

	function connection_200 (){
	// detalles de la conexion
	
	// establecemos una conexion con el servidor postgresSQL
	
	$host        = "host = ";
	$port        = "port = ";
	$dbname      = "dbname = ";
	$credentials = "user =  password = ";
	$options = "client_encoding = UTF8";
	// establecemos una conexion con el servidor postgresSQL
	$dbconn = pg_connect("$host $port $dbname $credentials $options");
	return $dbconn;

	}
?>
