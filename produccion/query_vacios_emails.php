<?php

	function connection181 (){
		$host        = "host = 192.168.10.181";
		$port        = "port = 5432";
		$dbname      = "dbname = bdSueldos";
		$credentials = "user = pablosanchez password = psbj2015";
		$options = "client_encoding = UTF8";
		$dbconn = pg_connect("$host $port $dbname $credentials $options");
		return $dbconn;
	}

	function filtro_padronElec_emailsVacios(){
			
		$query_sql = "SELECT DISTINCT(pp.matricula)as dni, 
						pp.apellido as apellido,
						pp.nombre as nombres,
						pp.domicilio as observaciones,
						pp.sexo,
						cid.email as cidemail
					FROM transp.padron_electoral_paso2019 pp
					LEFT JOIN cidig.persona cid on pp.matricula::varchar = cid.cuil_documento
					where cid.cuil_documento is not null AND cid.email = '' AND (LENGTH(pp.matricula::varchar) >= 7)
					limit 15000";
		//personas que no estan en cidig
		$personas_emailsVacios_cidig = pg_query(connection181(), $query_sql);
		return $personas_emailsVacios_cidig;
	}

	function cidig_update_emailsVacios($dni_persona){
		
		$query_update = "UPDATE cidig.persona SET  email = null 
						WHERE cuil_documento = '$dni_persona'";
		$update_cidig = pg_query(connection181(),$query_update);
		return $update_cidig;

		
	}

	function filtro_padron_interior(){
			
		$query_sql = "SELECT pp.circuito,pp.matricula as dni,
						pp.apellido as apellido,
						pp.nombre as nombres,
						pp.domicilio as observaciones,
						pp.sexo
					FROM transp.padron_electoral_paso2019 pp
					LEFT JOIN cidig.persona cid on pp.matricula::varchar = cid.cuil_documento
					INNER JOIN cidig.persona_natural nn on nn.id_persona = cid.id_persona
					where cid.cuil_documento is not null AND
					nn.ciudad_nac is null and
					pp.circuito in ('1','2','2A','3','4','5','5A','5B','5C','6','7','7A','7B','8','9','9A','10')
					limit 15000
					";
		$personas_interior_cidig = pg_query(connection181(), $query_sql);
		return $personas_interior_cidig;
	}

	function get_idPersona($dni){
			
		$query_sql = "SELECT cp.id_persona AS id_pers FROM cidig.persona cp
		WHERE cp.cuil_documento = '$dni'";
		$id_persona = pg_query(connection181(), $query_sql);

		return $id_persona;
		
	}

	function cidig_update_ciudad($idPersona){
		
		$query_update = "UPDATE cidig.persona_natural SET  ciudad_nac = 'Corrientes' 
						WHERE id_persona = $idPersona";
		$update_cidig = pg_query(connection181(),$query_update);
		return $update_cidig;
	}



?>