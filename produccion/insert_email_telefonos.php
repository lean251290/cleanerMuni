
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

include 'data_cleaner.php';
include 'query_base_pro.php';
include 'quitar_tildes.php';

 $cantidad =0;

//$dbconn = pg_connect($conn_string);

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
	//$personas185 = sube_personas();
	$personas = encRespPerEmails();
	// sistemas sube 185
	//$personas = sube_personas();
	//$personas = sube_solicitudes();

	if (!empty($personas)){

		// lo convierto en un array y luego lo recorro
		while ($persona = pg_fetch_array($personas)) {

				//Verifica si tiene email
				$dni_persona = $persona['dni'];

				//vrifica si tiene Email

				if (!empty($persona['email'])){

					$email_persona = pg_escape_string($persona['email']);
					$sin_acento = eliminar_acentos($email_persona);

					$email_validado = clear_email($sin_acento);
					/*HASTA ACA LLEGO BIEN*/
					echo $email_validado;

					if($email_validado !== $persona['cidemail']){
						//cidig_update($email_validado,$dni_persona);


					}
			 	}


				//Verifica si tiene celular

				if(!empty($persona['celular'])) {
					echo (!empty($persona['celular']));
					//Falta guardar id_persona, telefono, telefono_corregido para realizar insert posteriormente
					$id_persona = $persona['idpersona'];

						$celular = $persona['celular'];
						$tel_corregido = clear_phone($celular);

						if(($tel_corregido != null) and (strlen($tel_corregido) <=10)){
							//Realizar insert en cidig.telefono_persona
							$id_telefono_tipo = phone_code($tel_corregido);
							// insert_cidig_telefonoPersona($id_persona, $tel_corregido,$id_telefono_tipo);

							//insert_cidig_telefonoPersona($id_persona, $tel_corregido,$id_telefono_tipo);
						}

						$cantidad +=1;
						?>
						<tr>
						<td><?php echo $cantidad?></td>
						<td><?php echo $id_persona?></td>
						<td><?php echo $celular?></td>
						<td><?php echo $tel_corregido?></td>
						<td><?php echo $id_telefono_tipo?></td>
						</tr>
						<?php

				}

				if(!empty($persona['telefono'])) {
					//Falta guardar id_persona, telefono, telefono_corregido para realizar insert posteriormente
					$id_persona = $persona['idpersona'];
					if (verify_idPersona_inTelefonoPersona($id_persona) == true) {
						$telefono = $persona['telefono'];
						$tel_corregido = clear_phone($telefono);
						if(($tel_corregido != null) and (strlen($tel_corregido) <=10)){
							//Realizar insert en cidig.telefono_persona
							$id_telefono_tipo = phone_code($tel_corregido);
							 //insert_cidig_telefonoPersona($id_persona, $tel_corregido,$id_telefono_tipo);

							 $cantidad +=1;
								?>
								<tr>
								<td><?php echo $cantidad?></td>
								<td><?php echo $id_persona?></td>
								<td><?php echo $telefono?></td>
								<td><?php echo $tel_corregido?></td>
								<td><?php echo $id_telefono_tipo?></td>
								</tr>
								<?php
						}


					}

				}

			}

	}
}

// Close connection
pg_close(connection_200());
?>

</table>
</body>
</html>