<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table width="70%" border="1px" align="center">
	<tr>
		<td><b>cant</b></td>
        <td><b>dni</b></td>
      	<td><b>apyn</b></td>
      	<td><b>fecha_nac</b></td>
      	<td><b>sexo</b></td>
      	<td><b>direccion</b></td>
      	<td><b>barrio</b></td>

  	</tr>


<?php

include 'data_cleaner.php';
include 'query_base_pro.php';
// detalles de la conexion

//$dbconn = pg_connect($conn_string);

// Revisamos el estado de la conexion en caso de errores. 
if(!connection185()) {
echo "Error: No se ha podido conectar a la base de datos\n";
} else {


	//array de personas que se deben insertar en cidig.persona y cidig.persona_natural
	//-------------------------------------------------------------------------------

	//$personas = filtro_sac_personas();

	//$personas = filtro_territorio_cid();

	$personas = filtro_sube185_cidig181();	

	if (!empty($personas)){

		$cantidad = 0;
		// lo convierto en un array y luego lo recorro
		while ($persona = pg_fetch_array($personas)) {

          	$dni = $persona['dni'];
          
          	$apellido = pg_escape_string($persona['apellido']);
          	$nombres = pg_escape_string($persona['nombres']);
          	$fecha_nac = $persona['fecha_nac'];

          	$apyn = strtoupper($apellido) . ', ' . ucwords(strtolower($nombres));

          	$sexo = pg_escape_string($persona['sexo']);
          	$barrio = $persona['barrio'];
			$direccion = pg_escape_string($persona['direccion']);
          	
          	$id_tipo_documento = 1;

          	if($sexo == 'M'){
            	$id_sexo = 1;
          	}else{
            	$id_sexo = 2;
          	}
          		 
          	

          	var_dump($barrio);
          	var_dump($direccion);


   //        	$insert_persona = insert_personas_cidig181($dni, $id_tipo_documento);

			// if ($insert_persona) {
				
			// 	$id_persona = get_idPersona($dni);
   //        		$id_p = pg_fetch_array($id_persona);
   //        		$idPersona = $id_p['id_pers'];
          		
			// 	//inserto Persona Natural
			// 	$insertar_personaNat = insert_personas_natural181($idPersona, $apyn, $fecha_nac, $id_sexo);

			// 	if($insertar_personaNat){

			// 		//inserto domicilio
			// 		$insertar_dom = insert_domicilio_cidig181($barrio, $direccion);

			// 		if($insertar_dom){

			// 			$id_dom = get_idDomicilio($barrio, $direccion);
		 //          		$id_d = pg_fetch_array($id_dom);
		 //          		$idDomicilio = $id_p['id_dom'];

			// 			//inserto persona_domicilio	
			// 			$insertar_per_dom = insert_persona_domicilio_cidig181($idPersona, $idDomicilio);
			// 		}
			// 	}
			// }

			$cantidad++;

				?>
					<tr>
						<td><?php echo $cantidad?></td>
						<td><?php echo $dni?></td>
		               	<td><?php echo $apyn?></td>
		               	<td><?php echo $fecha_nac?></td>
		               	<td><?php echo $id_sexo . '->' .$sexo?></td>
		               	<td><?php echo $direccion?></td>
		               	<td><?php echo $barrio?></td>
						
					</tr>
				<?php 

			

		}


	} 

}

// Close connection
pg_close(connection185());
?>



</table>
</body>
</html>