
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
$conn_string = "";
 $cantidad =0;

// establecemos una conexion con el servidor postgresSQL
$dbconn = pg_connect($conn_string);

// Revisamos el estado de la conexion en caso de errores. 
if(!$dbconn) {
echo "Error: No se ha podido conectar a la base de datos\n";
} else {

	//Macheo turnos.personas con sac.ciudadanos	
	$query_sql = 'SELECT tt.documento,tt.apyn,tt.email from turnos.personas AS tt
	INNER JOIN cidig.persona cid ON cid.cuil_documento::bigint = tt.documento
	WHERE tt.email IS NOT NULL ';

	$personas = pg_query($dbconn, $query_sql);



	// lo convierto en un array y luego lo recorro
	while ($persona = pg_fetch_array($personas)) {
		$salida= array();
		if ($persona['email'] != null){

			
			//$email = $persona['email'];
			//exec("python prueba.py '".$email."'",$salida);
			
			//$persona['email'] = $salida[0];

			$dni_persona = $persona['documento'];
			// query para ir a buscar el registro actual al schema cidig.persona
			$query_sim = "SELECT simP.*, tt.apyn FROM cidig.persona AS simP
							INNER JOIN turnos.personas tt on simP.cuil_documento::bigint = tt.documento
							WHERE simP.cuil_documento::bigint = $dni_persona";
			$personas_sim = pg_query($dbconn, $query_sim);

			// lo convierto en un array y luego lo recorro.


			while ($persona_sim = pg_fetch_array($personas_sim)) {

				if($persona_sim['cuil_documento'] != null){
					if($persona_sim['email'] == null){

						$email = $persona['email'];
						exec("python prueba.py '".$email."'",$salida);

						$email_validado = $salida[0];
						$cantidad +=1;
					//$persona_sim->save();
						?>
						<tr>
							<td><?php echo $cantidad?></td>
							<td><?php echo $persona_sim['apyn']?></td>
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