
<html>
<head>
	<title></title>
</head>
<body>
	<table width="70%" border="1px" align="center">
	<tr>
		<td>NRO</td>

    	<td>DNI</td>

    	<td>EMAIL</td>

    	<td>EMAIL VALIDADO</td>

  	</tr>


<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
include 'data_cleaner.php';
include 'query_base_pro.php';
include 'quitar_tildes.php';
// detalles de la conexion
 $cantidad =0;

// Revisamos el estado de la conexion en caso de errores.
if(!connection_200()) {
echo "Error: No se ha podido conectar a la base de datos\n";
} else {

	//$personas = notas_gestores();
	//$personas = transp_infraEstadistica();
	//$personas = portal_agentes();

	//$personas = notas_ciudadanos();
	//$personas = proy_usuarios();
	//$personas = sac_ciudadanos();
	//$personas = sac_contacto_web();
	//$personas = turnos_personas();
	//$personas = turnos_solicitudes();
	//$personas = transp_empresasTransporte();
	$personas = encRespPerEmails();
	/*$datos = pg_fetch_object($personas);
	var_dump(json_encode($datos));
	exit();*/


	// sistemas sube 185
	//$personas = sube_personas();
	//$personas = sube_solicitudes();

	if (!empty($personas)){
		// lo convierto en un array y luego lo recorro
		while ($persona = pg_fetch_array($personas)) {
				//Verifica si tiene email
			/*var_dump($persona);*/

				$dni_persona = $persona['dni'];
				if (!empty($persona['email'])){

					$email_persona = pg_escape_string($persona['email']);

					$sin_acento = eliminar_acentos($email_persona);

					$email_validado = clear_email($sin_acento);
					if ($email_validado === null) {
						$email_validado = '';
					}
					/*var_dump($email_validado);*/
					if($email_validado !== $persona['cidemail']){
						//var_dump($email_validado);
						cidig_update($email_validado,$dni_persona);
						//no va a actualizar email xq si no pvalida devuele null
						$cantidad +=1;
						?>
						<tr>
						<td><?php echo $cantidad?></td>
						<td><?php echo $dni_persona?></td>
						<td><?php echo $email_persona?></td>
						<td><?php echo $email_validado?></td>
						</tr>
						<?php
					}
			 }


				//Verifica si tiene telefono
				if(!empty($persona['telefono'])) {
					//Falta guardar id_persona, telefono, telefono_corregido para realizar insert posteriormente
					$id_persona = $persona['idpersona'];
					if (verify_idPersona_inTelefonoPersona($id_persona) == false) {
						$telefono = $persona['telefono'];
						$tel_corregido = clear_phone($telefono);

						if(($tel_corregido != null) and (strlen($tel_corregido) <=10)){
							//Realizar insert en cidig.telefono_persona
							$id_telefono_tipo = phone_code($tel_corregido);
							// insert_cidig_telefonoPersona($id_persona, $tel_corregido,$id_telefono_tipo);

							//insert_cidig_telefonoPersona($id_persona, $tel_corregido,$id_telefono_tipo);
						}

					}

				}

			}

	}
}

// Close connection181
pg_close(connection_200());
?>

</table>
<!-- con esta funcion cargo la pagina x intervalos de tiempo -->
<!-- <script type="text/javascript">
	(function(){
		setInterval(
			function(){
				document.location.reload()
		},
		100000000)
	})()
</script>
 --></body>
</html>