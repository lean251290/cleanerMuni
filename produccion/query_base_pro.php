<?php

	include 'conexion.php';

	// query Sistemas 185
	function sube_personas(){
		//$connection181 = string_connection181();

		$query_sql = "SELECT ss.id_per as idpersona,ss.dni as dni,ss.correo as email,cidemail,ss.tel as telefono
						FROM sube.personas ss
							inner join (select cid.* from dblink('host=192.168.10.181 port = 5432 dbname=bdSueldos user = pablosanchez password = psbj2015',
							'select cuil_documento as documento,id_persona as idpersona, email as cidemail from cidig.persona')as cid
							(documento VARCHAR(40), idpersona bigint, cidemail VARCHAR(200))) as nue
							on ss.dni = documento
						WHERE ss.correo IS NOT NULL OR ss.tel IS NOT NULL";
		$subePersona = pg_query(connection185(), $query_sql);

		return $subePersona;

	}

	function sube_solicitudes(){
		//$connection181 = string_connection181();

		$query_sql = "SELECT idpersona,ss.dni as dni,ss.email as email,cidemail,ss.telefono as telefono
						FROM sube.solicitudes ss
							inner join (select cid.* from dblink('host=192.168.10.181 port = 5432 dbname=bdSueldos user = pablosanchez password = psbj2015',
							'select cuil_documento as documento,id_persona as idpersona, email as cidemail from cidig.persona')as cid
							(documento VARCHAR(40), idpersona bigint, cidemail VARCHAR(200))) as nue
							on ss.dni = documento::bigint
						WHERE ss.email IS NOT NULL OR ss.telefono IS NOT NULL";
		$subeSolicitudes = pg_query(connection185(), $query_sql);

		return $subeSolicitudes;

	}




	// query notas gestores
	function notas_gestores(){

		$query_sql = 'SELECT DISTINCT(gg.documento) as dni,
							cid.id_persona as idpersona,
							gg.email_gestor as email,
							cid.email as cidemail,
							gg.telefonos as telefono
						FROM notas.gestores gg
						INNER JOIN cidig.persona cid ON cid.cuil_documento::bigint = gg.documento
						WHERE gg.email_gestor IS NOT NULL OR gg.telefonos IS NOT NULL';
		$notas_ges = pg_query(connection(), $query_sql);

		return $notas_ges;


	}

	function transp_infraEstadistica(){

		$query_sql = "SELECT cp.id_persona AS idpersona,
		transp_i.dni AS dni,
		transp_i.email AS email,
		cp.email AS cidemail,
		transp_i.cel AS telefono
		FROM transp.infra_estadistica transp_i
			INNER JOIN cidig.persona cp ON cp.cuil_documento = transp_i.dni::text
			WHERE transp_i.cel IS NOT NULL OR transp_i.email IS NOT NULL
			ORDER BY cp.id_persona";

		$infra_esta = pg_query(connection(), $query_sql);

		return $infra_esta;

	}


	function portal_agentes (){

		$query_sql = ' SELECT DISTINCT(pp.dni)as dni,cid.id_persona as idpersona,pp.email as email,cid.email as cidemail,pp.telefono as telefono
					FROM portal_agente.lvl_users pp
					INNER JOIN cidig.persona cid ON cid.cuil_documento::bigint = pp.dni
					WHERE pp.fcm IS NOT NULL OR pp.telefono IS NOT NULL';
		$portal = pg_query(connection(), $query_sql);
		return $portal;
	}


	function notas_ciudadanos (){

		$query_sql = 'SELECT DISTINCT(nn.documento) as dni,cid.id_persona as idpersona,nn.email as email, cid.email as cidemail,nn.telefono_fijo as telefono FROM notas.ciudadanos nn
					INNER JOIN cidig.persona cid ON cid.cuil_documento::bigint = nn.documento
					WHERE nn.email IS NOT NULL OR nn.telefono_fijo IS NOT NULL';
		$notasCiudadabos = pg_query(connection(), $query_sql);
		return $notasCiudadabos;
	}


	function proy_usuarios(){

		$query_sql = 'SELECT DISTINCT(ss.dni) as dni,cid.id_persona as idpersona,ss.email as email, cid.email as cidemail,ss.celular as telefono
						FROM proy.usuarios ss
						INNER JOIN cidig.persona cid ON cid.cuil_documento::bigint = ss.dni
						WHERE ss.email IS NOT NULL OR ss.celular IS NOT NULL';
		$proyUsuarios = pg_query(connection(), $query_sql);
		return $proyUsuarios;
	}


	function sac_ciudadanos(){

		$query_sql = "SELECT DISTINCT(cc.documento) as dni,cid.id_persona as idpersona,cc.email as email, cid.email as cidemail,cc.celular as celular,cc.telefonos as telefono FROM sac.ciudadanos as cc
					INNER JOIN cidig.persona cid on cid.cuil_documento = cc.documento::varchar
					WHERE cc.telefonos IS NOT NULL
					order by cid.id_persona desc
					limit 0 offset 0";
		$sacCiudadanos = pg_query(connection181(), $query_sql);
		return $sacCiudadanos;
	}


	function sac_contacto_web(){

		$query_sql = 'SELECT DISTINCT(ww.documento) as dni,cid.id_persona as idpersona,ww.email as email, cid.email as cidemail,ww.telefonos as telefono from sac.contacto_web ww
						INNER JOIN cidig.persona cid on cid.cuil_documento::bigint = ww.documento
						WHERE ww.email is not null OR ww.telefonos IS NOT NULL';
		$sacContacto = pg_query(connection(), $query_sql);
		return $sacContacto;
	}

	// solo devuelve emails
	function sac_gestores(){

		$query_sql = 'SELECT DISTINCT(gg.documento) as dni,gg.email as email, cid.email as cidemail FROM sac.gestores gg
						INNER JOIN cidig.persona cid ON cid.cuil_documento::bigint = gg.documento
						WHERE gg.email is not null';
		$sacGestores = pg_query(connection(), $query_sql);
		return $sacGestores;
	}

	//traigo telefonos pero tiene celular
	function turnos_personas(){

		$query_sql = 'SELECT DISTINCT(tt.documento) as dni,cid.id_persona as idpersona,tt.email as email, cid.email as cidemail,tt.tel_contacto as telefono from turnos.personas AS tt
						INNER JOIN cidig.persona cid ON cid.cuil_documento::bigint = tt.documento
						WHERE tt.email IS NOT NULL OR tt.tel_contacto IS NOT NULL';
		$turnosPersonas = pg_query(connection(), $query_sql);
		return $turnosPersonas;
	}

	function turnos_solicitudes(){

		$query_sql = 'SELECT DISTINCT(ss.dni) as dni,cid.id_persona as idpersona,ss.email as email, cid.email as cidemail,ss.tel_contacto as telefono FROM turnos.solicitudes ss
				INNER JOIN cidig.persona cid ON cid.cuil_documento::bigint = ss.dni
				WHERE ss.email IS NOT NULL OR ss.tel_contacto IS NOT NULL';
		$turnosSolicitudes = pg_query(connection(), $query_sql);
		return $turnosSolicitudes;
	}



	function cidig_update($email_validado,$dni_persona){

		$query_update = "UPDATE cidig.persona SET email = '$email_validado'
						WHERE cuil_documento = '$dni_persona'";
		$update_cidig = pg_query(connection_200(),$query_update);
		return $update_cidig;
	}

	function transp_empresasTransporte(){

		$query_sql = "SELECT cp.id_persona AS idpersona,
		t_et.telefonos AS telefono,
		t_et.email AS email,
		cp.email AS cidemail
		FROM transp.empresas_transporte t_et
			INNER JOIN cidig.persona cp ON cp.id_persona = t_et.empresa_id
			WHERE t_et.telefonos IS NOT NULL OR t_et.email IS NOT NULL";

		$transp_empresas_t = pg_query(connection(), $query_sql);

		return $transp_empresas_t;
	}


	//Funcion para retornar registros que no se encuentran en cidig.telefono_persona y con telefonos no nulos para corregirse, a traves de una query, y posteriormente insertarse en cidig.telefono_persona

	function insert_cidig_telefonoPersona($id_persona, $tel_corregido,$id_telefono_tipo){

       	$insert_phone_query = "INSERT INTO
         cidig.telefono_persona (id_telefono_tipo, id_persona, numero, id_estado, observaciones)
         VALUES ($id_telefono_tipo, $id_persona, '$tel_corregido', 1, '')";

       	$insert_phone = pg_query(connection_200(), $insert_phone_query);

       	return $insert_phone;
	}


	function verify_idPersona_inTelefonoPersona($id_persona){

		$query_pers = "SELECT tp.id_persona
			FROM cidig.telefono_persona tp
		    WHERE tp.id_persona = $id_persona";

		$r = pg_query(connection_200(), $query_pers);
		$rows = pg_num_rows($r);


		if( $rows <= 1){
			return true;
		}else{
			return false;
		}


	}

	//filtro de personas que no estan en cidig
	function filtro_sac_personas(){

		$query_sql = 'SELECT DISTINCT(cc.documento)as dni,
						cc.apyn,
						cc.email,
						cc.celular,
						cc.codba as id_barrio,
						cc.codca as id_calle,
						cc.altura,
						cc.piso_dpto as dpto,
						cc.otro_dato_dom as observaciones
						FROM sac.ciudadanos as cc
					WHERE cc.documento::varchar NOT IN (select cid.cuil_documento from cidig.persona as cid)';
		//personas que no estan en cidig
		$personaNo_cidig = pg_query(connection(), $query_sql);

		return $personaNo_cidig;


	}

	function filtro_cid_per(){

		$query_sql = 'SELECT cid.id_persona,cc.apyn FROM cidig.persona as cid
						left join sac.ciudadanos cc on cc.documento = cid.cuil_documento::int
						WHERE cid.id_persona_tipo = 1 and cid.cuil_tipo is null and cid.id_persona not IN (select per.id_persona from cidig.persona_natural as per)
						';
		//personas que no estan en cidig
		$personaNo_cidig = pg_query(connection(), $query_sql);

		return $personaNo_cidig;


	}



	//Insercion de personas que no estan en Cidig.personas
	function insert_personas_cidig($dni,$email){

       	$insert_persona_query = "INSERT INTO
         cidig.persona (cuil_documento, email)
         VALUES ($dni, '$email')";

       	$insert_persona = pg_query(connection(), $insert_persona_query);

       	return $insert_persona;
	}

	//insercion en la tabla_persona_natural

	function insert_personas_natural($id_persona,$apyn){

       	$insert_persona_query = "INSERT INTO
         cidig.persona_natural (id_persona, apyn)
         VALUES ($id_persona, '$apyn')";

       	$insert_persona = pg_query(connection(), $insert_persona_query);

       	return $insert_persona;
	}


	//// Prueba (Desarrollo)
	//Insercion de personas que no estan en Cidig.personas
	function insert_personas_cidig181($dni, $tipo_documento){

       	$insert_persona_query = "INSERT INTO
         cidig.persona (cuil_documento, id_tipo_documento)
         VALUES ('$dni', $tipo_documento)";

       	$insert_persona = pg_query(connection181(), $insert_persona_query);

       	return $insert_persona;
	}

	function insert_personas_natural181($idPersona, $apyn, $fe_nac, $sexo){

       	$insert_persona_query = "INSERT INTO
         cidig.persona_natural (id_persona, apyn, fe_nac, id_sexo)
         VALUES ($idPersona, '$apyn', '$fe_nac', $sexo)";

       	$insert_personaNat = pg_query(connection181(), $insert_persona_query);

       	return $insert_personaNat;
	}


	///filtro de territorio.personas  que no estan en cidig
	  function filtro_territorio_cid(){

	    $query_sql = 'SELECT DISTINCT (pp.documento) as dni,
	            pp.genero,
	            pp.apyn,
	            pp.fecha_nac,
	            pp.email,
	            pp.id_calle,
	            pp.altura,
	            pp.dpto,
	            pp.id_barrio,
	            pp.observaciones,
	            pp.id_nivel_educacion,
	            pp.est_civil,
	            pp.sexo FROM territorio.personas as pp
	           WHERE pp.documento NOT IN (select cid.cuil_documento::int from cidig.persona as cid)
	           limit 200
	           ';
	    //personas que no estan en cidig
	    $territorioNo_cidig = pg_query(connection181(), $query_sql);

	    return $territorioNo_cidig;

	  }



	// utilizo para simular un id_autoincremental para insertar en cidig_pablo.persona_natural
	function ultimoReg_idPersonaNat(){

		$query_sql = 'select max(id_persona_natural) as ult_idper_nat from cidig.persona_natural';
		//personas que no estan en cidig
		$ultIdPerNat_cidig = pg_query(connection_200(), $query_sql);

		return $ultIdPerNat_cidig;

	}

	function filtro_sube200_cidig_200(){
		$query = "SELECT sp.id_per,
	      sp.dni,
	      sp.correo,
	      sp.sexo,
	      sp.apellido,
	      sp.nombres,
	      sp.direccion,
	      sp.barrio
	      FROM sube.personas sp
	      WHERE ((LENGTH(sp.dni) = 7) OR (LENGTH(sp.dni) = 8) )
	      AND (sp.dni NOT IN (SELECT cp.cuil_documento FROM cidig.persona cp))
	      AND (sp.dni NOT IN
	      		(SELECT sp.dni FROM sube.personas sp WHERE (LENGTH(sp.dni) = 7) AND (SUBSTRING(sp.dni, 1, 1) = '0'))
	      	  )
	      ORDER BY sp.dni ASC
	      LIMIT 20";

	    $subeNo_cidig = pg_query(connection_200(), $query);

		return $subeNo_cidig;
	}

	function filtro_sube185_cidig181(){
		$query = "SELECT sp.id_per,
	      sp.dni,
	      sp.correo,
	      sp.sexo,
	      sp.apellido,
	      sp.nombres,
	      sp.fecha_nac,
	      sp.direccion,
	      sp.barrio
	      FROM sube.personas sp
	      WHERE ((LENGTH(sp.dni) = 7) OR (LENGTH(sp.dni) = 8) )
	      AND sp.dni NOT IN (SELECT cp.* FROM dblink('host=192.168.10.181 port = 5432 dbname=bdSueldos user = juanmartinez password = jmbj2017',
	        'SELECT cuil_documento FROM cidig.persona')AS cp
	        (cuil_documento VARCHAR(40)))
	      AND sp.dni NOT IN
	      		(SELECT sp.dni FROM sube.personas sp WHERE (LENGTH(sp.dni) = 7) AND (SUBSTRING(sp.dni, 1, 1) = '0'))

	      ORDER BY sp.dni ASC
	      LIMIT 1";

	    $subeNo_cidig = pg_query(connection185(), $query);

		return $subeNo_cidig;
	}

	function insert_domicilio_cidig181($barrio, $domicilio){

       	$insert_persona_query = "INSERT INTO
         cidig.domicilio (id_barrio, otro_dato_domi)
         VALUES ($barrio, '$domicilio')";

       	$insert_dom = pg_query(connection181(), $insert_persona_query);

       	return $insert_dom;
	}


	function get_idDomicilio($barrio, $direccion){

		$query_dom = "SELECT d.id_domicilio AS id_dom FROM cidig.domicilio d
		WHERE d.id_barrio = $barrio AND d.otro_dato_domi = '$direccion'";

		$id_domicilio = pg_query(connection181(), $query_dom);

		return $id_domicilio;
	}

	//Insercion de personas que no estan en Cidig.personas
	//// Prueba (Desarrollo)
	//Insercion de personas que no estan en Cidig.personas
	function insert_personas_sim($dni,$tipo_persona,$email,$cuil_tipo,$cuil_digito,$id_tipo_documento,$cuil,$control_doc){

		if (!empty($email)){
			$insert_persona_query = "INSERT INTO
	         cidig.persona (cuil_documento,id_persona_tipo,email,cuil_tipo,cuil_digito,cuil,id_tipo_documento,control_doc)
	         VALUES ($dni,$tipo_persona,null,NULLIF('$cuil_tipo','')::integer,NULLIF('$cuil_digito','')::integer,$cuil,$id_tipo_documento,'$control_doc')";

	       	$insert_persona = pg_query(connection_200(), $insert_persona_query);

		} elseif (empty($cuil_tipo) and empty($cuil_digito)) {
	       	$insert_persona_query = "INSERT INTO
	         cidig.persona (cuil_documento,id_persona_tipo,email,id_tipo_documento,control_doc)
	         VALUES ($dni,$tipo_persona,null,$id_tipo_documento,'$control_doc')";

	       	$insert_persona = pg_query(connection_200(), $insert_persona_query);
       	}

       	return $insert_persona;
	}

	//busco el id_persona de la persona que recientemente se inserto en cidig.persona
	function get_idPersona($dni){

		$query_sql = "SELECT cp.id_persona AS id_pers FROM cidig.persona cp
		WHERE cp.cuil_documento = '$dni'";
		$id_persona = pg_query(connection_200(), $query_sql);

		return $id_persona;

	}

	//Una vez insertado en cidig.persona procedemos a insertar en cidig.persona_natural

	function insert_personasNatural_sim($idPersona,$apyn,$fe_nac,$sexo,$genero){

		if ($fe_nac == NULL){
			$insert_persona_query = "INSERT INTO
         cidig.persona_natural (id_persona,apyn,fe_nac,id_sexo,id_genero,ciudad_nac,provincia_nac)
         VALUES ($idPersona,'$apyn',NULL,NULLIF('$sexo','')::integer,NULLIF('$genero','')::integer,'Corrientes','Corrientes')";

       		$insert_personaNat = pg_query(connection_200(), $insert_persona_query);

		}else {
			$insert_persona_query = "INSERT INTO
         cidig.persona_natural (id_persona,apyn,fe_nac,id_sexo,id_genero,ciudad_nac,provincia_nac)
         VALUES ($idPersona,'$apyn','$fe_nac',NULLIF('$sexo','')::integer,NULLIF('$genero','')::integer,'Corrientes','Corrientes')";

       		$insert_personaNat = pg_query(connection_200(), $insert_persona_query);
		}


		return $insert_personaNat;

	}


	//Una vez insertado en cidig.persona procedemos a insertar en cidig.persona_juridica

	function insert_personasJuridica_sim($idPersona,$nombre_juridico){
		$insert_persona_query = "INSERT INTO
         cidig.persona_juridica (id_persona,razon_social,nombre_fantasia)
         VALUES ($idPersona,'$nombre_juridico','$nombre_juridico')";

       		$insert_personaJuridica = pg_query(connection_200(), $insert_persona_query);

		return $insert_personaJuridica;

	}

	//inserta los datos respecto a domicilio
	function insert_domicilio_sim($barrio,$calle,$altura,$depto,$dato_domi){
		$insert_persona_query = "INSERT INTO
         cidig.domicilio (id_barrio,id_calle,altura,depto,otro_dato_domi)
         VALUES (NULLIF('$barrio','')::integer, NULLIF('$calle','')::integer,NULLIF('$altura','')::integer,'$depto','$dato_domi')";

       	$insert_dom = pg_query(connection_200(), $insert_persona_query);

       	return $insert_dom;
	}

	//obtener el ultimo id_domicilio que se inserto para luego asociar junto con id_persona en cidig.persona_domicilio
	function get_idDomicilio_sim(){

		$query_dom = "SELECT max(id_domicilio) as id_dom FROM cidig.domicilio";

		$id_domicilio = pg_query(connection_200(), $query_dom);

		return $id_domicilio;
	}

	//se actualiza la tabla intermedia cidig.persona_domicilio
	function insert_personaDomicilio_sim($id_persona, $id_domicilio){

       	$insert_persona_query = "INSERT INTO
         cidig.persona_domicilio (id_persona, id_domicilio, id_tipo_domicilio, id_estado)
         VALUES ($id_persona, $id_domicilio, 1, 1)";

       	$insert_dom = pg_query(connection_200(), $insert_persona_query);

       	return $insert_dom;
	}

	//--------------------------------------------------------------------

	function update_capApyn_PersonaNatural($idPersona,$apeynom){

		$query_update = "UPDATE cidig.persona_natural SET  apyn = '$apeynom'
						WHERE id_persona = $idPersona";
		$update_cidig = pg_query(connection181(),$query_update);
		return $update_cidig;
	}

	function filtro_capApyn_personaNat(){

	    $query_sql = 'SELECT cid.id_persona as idPersona,
						cid.cuil_documento as dni,
						pp.apyn as apyn,
						nn.apyn as cidigapyn
					FROM cidig.persona as cid
		inner join territorio.personas pp on pp.documento::varchar = cid.cuil_documento
		left join cidig.persona_natural nn on nn.id_persona = cid.id_persona
		where cid.cuil_documento::integer = 55773139
		';
	    //personas que no estan en cidig
	    $cidig_personaNat = pg_query(connection181(), $query_sql);

	    return $cidig_personaNat;

	  }

	  function filtroSac_capApyn_personaNat(){

	    $query_sql = 'SELECT cid.id_persona as idpersona,
	    				cid.cuil_documento as dni,
	    				cc.apyn as apyn,
	    				nn.apyn as cidigapyn
					FROM cidig.persona as cid
					inner join sac.ciudadanos as cc on cc.documento::varchar = cid.cuil_documento
					left join cidig.persona_natural nn on nn.id_persona = cid.id_persona
					order by cid.id_persona desc
		';
	    //personas que no estan en cidig
	    $cidig_personaNat = pg_query(connection181(), $query_sql);

	    return $cidig_personaNat;

	  }


	  //padron_electoral_pasos2019

	  //Filtro de personas que estan en el padron electoral pasos 2019 pero que no estan en el SIM
	function filtro_padron_electoral(){

		$query_sql = "SELECT pp.circuito,
					pp.matricula as dni,
					pp.apellido as apellido,
					pp.nombre as nombres,
					pp.domicilio as observaciones,
					pp.sexo
			FROM transp.padron_electoral_paso2019 pp
			LEFT JOIN cidig.persona cid on pp.matricula::varchar = cid.cuil_documento
			where cid.cuil_documento is null AND
			(LENGTH(pp.matricula::varchar) >= 7) and
				pp.circuito in ('1','2','2A','3','4','5','5A','5B','5C','6','7','7A','7B','8','9','9A','10')";
		//personas que no estan en cidig
		$personaNo_cidig = pg_query(connection181(), $query_sql);
		return $personaNo_cidig;
	}

	//Filtro de personas juridicas de tribunal.expediente pero que no estan en el SIM
	function filtro_tribunalExp_Fisica(){

		$query_sql = "SELECT DISTINCT(tt.nrodoc) as dni,
				id_tipo_persona as tipo_per,
				c05tipodoc as tipo_doc,
				tt.apyn as nombre_fant,
				tt.sexo,
				tt.domicilio as observaciones
			from tribunal.expediente as tt
			LEFT JOIN cidig.persona cid on  tt.nrodoc::varchar = cid.cuil_documento
			WHERE cid.cuil_documento is null and tt.id_tipo_persona = 1 and LENGTH(tt.nrodoc::varchar) >= 7
			ORDER BY tt.nrodoc desc
			LIMIT 1";
		//personas que no estan en cidig
		$personaNo_cidig = pg_query(connection_200(), $query_sql);
		return $personaNo_cidig;
	}
	//Filtro de personas juridicas de tribunal.expediente pero que no estan en el SIM (Funcion distintan por el cambio que existe en los registros en cuanto al DNI)
	function filtro_tribunalExp_Juridica(){

		$query_sql = "SELECT DISTINCT(tt.nrodoc) as dni,
						id_tipo_persona as tipo_per,
						c05tipodoc as tipo_doc,
						tt.apyn as nombre_fant,
						tt.sexo,
						tt.domicilio as observaciones
					FROM tribunal.expediente as tt
					LEFT JOIN cidig.persona cid on  substring(tt.nrodoc::text from 3 for 8) = cid.cuil_documento or tt.nrodoc::varchar = cid.cuil_documento
					WHERE cid.cuil_documento is null and tt.id_tipo_persona = 2 and LENGTH(tt.nrodoc::varchar) = 11
					ORDER BY tt.nrodoc desc
					limit 1";
		//personas que no estan en cidig
		$personaNo_cidig = pg_query(connection_200(), $query_sql);
		return $personaNo_cidig;
	}


	/*Listado de registros que estan en (enc.respuestas_personalizadas y cid.personas) cuyos emails en cidig sean null o vacio. Luego Acualizar y limpiarlos los emails de encuestas y actualizar cidig.*/
	function encRespPerEmails(){

		$query_sql = "SELECT cid.cuil_documento AS dni,cid.email AS cidemail,enc.email AS email FROM cidig.persona AS cid
						LEFT JOIN enc.respuestas_personalizadas AS enc ON cid.cuil_documento = enc.documento
						WHERE (cid.cuil_documento IS NOT NULL and enc.email IS NOT NULL) and (cid.email = '' OR cid.email IS NULL)
						LIMIT 20";
		$emailsEncuestas = pg_query(connection_200(), $query_sql);
		return $emailsEncuestas;

	}






?>