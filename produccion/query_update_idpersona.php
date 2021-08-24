<?php 

	include 'conexion.php';

	function update_idpersona_tribunal_jc_expediente($dni_persona,$id_persona){
		
		$query_update = "UPDATE tribunal_jc.expediente SET id_persona = $id_persona 
						WHERE nrodoc::varchar = '$dni_persona'";
		$update_cidig = pg_query(connection_200(),$query_update);
		return $update_origen;
	}

	//Filtro de personas fisicas de tribunal.expediente pero que estan en el SIM para setear id_persona en origen
	function tribunalExp_Fisica(){
			
		$query_sql = "SELECT DISTINCT(tt.nrodoc) as dni,
						tt.id_persona as id_persona,
						cid.id_persona as cid_idpersona,
						id_tipo_persona as tipo_per
					from tribunal_jc.expediente as tt
					LEFT JOIN cidig.persona cid on  tt.nrodoc::varchar = cid.cuil_documento
					WHERE cid.cuil_documento is not null and tt.id_persona is null and tt.id_tipo_persona = 1 and LENGTH(tt.nrodoc::varchar) >= 7
					ORDER BY tt.nrodoc desc
					LIMIT 1000";
		//personas que no estan en cidig
		$personaNo_cidig = pg_query(connection_200(), $query_sql);
		return $personaNo_cidig;
	}


?>