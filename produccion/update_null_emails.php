
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

include 'query_vacios_emails.php';
$cantidad =0;

// Revisamos el estado de la conexion en caso de errores. 
if(!connection181()) {
echo "Error: No se ha podido conectar a la base de datos\n";
} else {

	
		$personas = filtro_padronElec_emailsVacios();

		if (!empty($personas)){

			// lo convierto en un array y luego lo recorro
			while ($persona = pg_fetch_array($personas)) {

					//Verifica si tiene email
					$dni_persona = $persona['dni'];
							cidig_update_emailsVacios($dni_persona);
							$cantidad +=1;
							?>
							<tr>
							<td><?php echo $cantidad?></td>
							<td><?php echo $dni_persona?></td>
							</tr>
							<?php 

			}
		} 

	}

// Close connection
pg_close(connection181());
?>

</table>
</body>
</html>