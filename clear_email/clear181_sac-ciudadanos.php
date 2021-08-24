
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table width="70%" border="1px" align="center">
	<tr>
		<td>NRO</td>

		<td>APYN</td>

    	<td>DNI</td>

    	<td>EMAIL</td>

    	<td>EMAIL VALIDADO</td>

  	</tr>


<?php
// detalles de la conexion
$conn_string = "host=192.168.10.181 port=5432 dbname=bdSueldos user=pablosanchez password=psbj2015 options='--client_encoding=UTF8'";
 $cantidad =0;

// establecemos una conexion con el servidor postgresSQL
$dbconn = pg_connect($conn_string);

// Revisamos el estado de la conexion en caso de errores. 
if(!$dbconn) {
echo "Error: No se ha podido conectar a la base de datos\n";
} else {

	//Macheo turnos.personas con sac.ciudadanos	
	$query_sql = 'SELECT DISTINCT (cc.documento),cc.apyn,cc.email FROM sac.ciudadanos as cc
					inner join cidig.persona cid on cid.cuil_documento::bigint = cc.documento
					where cc.email is not null ';

	$personas = pg_query($dbconn, $query_sql);



	// lo convierto en un array y luego lo recorro
	while ($persona = pg_fetch_array($personas)) {
		$salida= array();
		if ($persona['email'] != null){

			
			//$email = $persona['email'];
			//exec("python prueba.py '".$email."'",$salida);
			
			//$persona['email'] = $salida[0];

			$dni_persona = $persona['documento'];
			$nombre_apellido =$persona['apyn'];
			// query para ir a buscar el registro actual al schema cidig.persona
			$query_sim = "SELECT simP.* FROM cidig.persona AS simP
							WHERE simP.cuil_documento::bigint = $dni_persona";
			$personas_sim = pg_query($dbconn, $query_sim);

			// lo convierto en un array y luego lo recorro.


			while ($persona_sim = pg_fetch_array($personas_sim)) {

				if($persona_sim['cuil_documento'] != null){
					if(empty($persona_sim['email'])){

						$email = $persona['email'];
						exec("python prueba.py '".$email."'",$salida);

						$email_validado = $salida[0];

						
						// if (isset($email_validado)){
						// 	$cidig_documento = $persona_sim['cuil_documento'];
						// 	$query_update = "UPDATE cidig.persona SET  email = '$email_validado' 
						// 					WHERE cuil_documento::bigint = $dni_persona";
						// 	$update_cidig = pg_query($dbconn,$query_update);
						// }

						$cantidad +=1;
					//$persona_sim->save();
						?>
						<tr>
							<td><?php echo $cantidad?></td>
							<td><?php echo $nombre_apellido?></td>
							<td><?php echo $persona_sim['cuil_documento']?></td>
							<td><?php echo $email?></td>
							<td><?php echo $email_validado?></td>
						 </tr>
					 	<?php 
					}

				}

			}
			
		}
		
	}

}
 
// Close connection
pg_close($dbconn);
?>


</table>
</body>
</html>