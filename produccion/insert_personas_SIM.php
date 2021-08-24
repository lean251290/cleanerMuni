<!DOCTYPE html>
<html>
<head>
   <title></title>
</head>
<body>
   <table width="70%" border="1px" align="center">
   <tr>
      <td><b>id_persona</b></td>
      <td><b>dni</b></td>
      <td><b>apyn</b></td>
      <td><b>sexo</b></td>
      <td><b>genero</b></td>
      <td><b>direccion</b></td>
      <td><b>barrio</b></td>
      <td><b>calle</b></td>
      <td><b>altura</b></td>
      <td><b>depto</b></td>
      <td><b>control</b></td>
      

   </tr>
<?php

include 'query_base_pro.php';

$cantidad =0;

if(!connection_200()) {
  echo "Error : No se pudo establecer la conexion a la base de datos: ";
  
}else {

    
        //$personas = filtro_sube200_cidig_200();
        //$personas = filtro_territorio_cid();
        //$personas = filtro_sac_personas();
        //$personas = filtro_padron_electoral();
        //$personas = filtro_tribunalExp_Fisica();
          //$personas  = filtro_tribunalExp_Juridica();

        
        if(!empty($personas)){
          while ($persona = pg_fetch_array($personas)) {

            $dni_persona = $persona['dni'];
            //$apyn = pg_escape_string($persona['apyn']);
            $barrio = $persona['id_barrio'];
            $genero = $persona['genero'];
            $tipo_per = $persona['tipo_per'];
            $fecha_nac = $persona['fecha_nac'];
            $email = pg_escape_string($persona['email']);
            $calle = $persona['id_calle'];
            $altura = $persona['altura'];
            $depto = pg_escape_string($persona['dpto']);
            $otro_dato_domi = pg_escape_string($persona['observaciones']);
            $nivel_educ = $persona['id_nivel_educacion'];
            $est_civil = pg_escape_string($persona['est_civil']);
          
            $apellido = pg_escape_string($persona['apellido']);
            $nombres = pg_escape_string($persona['nombres']);
            $nombre_fant= pg_escape_string($persona['nombre_fant']);

            // $apyn = strtoupper($apellido) . ', ' . ucwords(strtolower($nombres));
            // $apeynom =$apyn;

            //tratamiento nombre ficticio para personas juridicas
            $nombre_juridico = ucwords(strtolower($nombre_fant));

            // esto se habilita cuando es personas Fisicas
            $apellido = strstr($nombre_juridico, ',', true);
            $nombres = strstr($nombre_juridico, ',');
            $apeynomMay = strtoupper($apellido).ucwords(strtolower($nombres));
            if (!empty($apeynomMay)){
              $apeynom = $apeynomMay;
            }else {
              $apellido = strstr($nombre_juridico, ' ', true);
              $nombres = strstr($nombre_juridico, ' ');
              $apeynom = strtoupper($apellido) . ',' . ucwords(strtolower($nombres));
            }


            //control de DNI
            
            if ($tipo_per['tipo_per'] == 2){
              $tipo_persona =2;
                //tipo DNI
              $id_tipo_documento = 3;
              //por defecto Argentina
              $id_nacionalidad =1;
              $cuil = $dni_persona;
              $control_doc =$dni_persona.$id_tipo_documento.$id_nacionalidad;

              // verifico que el cuil tenga la longitud correspondiente a 11 caracteres
              if (strlen($dni_persona) == 11) {
                //sustraigo cuil_tipo y cuil_digito
                $cuil_tipo = substr($dni_persona, 0,2);
                $cuil_digito = substr($dni_persona, -1);

                // sustraigo el dni del cuil
                $dni_persona = substr($dni_persona,2,-1);
              }

            }else {
              $cuil = '';
              $tipo_persona =1;
                //tipo DNI
              $id_tipo_documento = 2;
              //por defecto Argentina
              $id_nacionalidad =1;
                $control_doc =$dni_persona.$id_tipo_documento.$id_nacionalidad;
            }
            

            $gen = $persona['genero'];
            $genero = substr($gen, 0,1);

            $sexo = $persona['sexo'];
            // $sexo = substr($sex, 0,1);

            if($sexo == 'M'){
              $id_sexo = 1;

            }else if ($sexo == 'F'){
              $id_sexo = 2;

            }else {
              $id_sexo =NULL;

            }


            if($genero == 'M'){
              $id_genero = 1;

            }else if ($genero == 'F'){
              $id_genero = 2;

            }else {
              $id_genero=NULL;

            }

            //verifico si el registro se encuentra en cidig.persona
            $id_persona = get_idPersona($dni_persona);
            $id_p = pg_fetch_array($id_persona);
            $idPersona = $id_p['id_pers'];

            if(is_null($idPersona)){
              //insertar registro que no esta en cidig.persona
              $insert_persona =insert_personas_sim($dni_persona,$tipo_persona,$email,$cuil_tipo,$cuil_digito,$id_tipo_documento,$cuil,$control_doc);

            } else {
                  //var_dump('nada');
                $insert_persona = false;
                //inserto domicilio en caso de que la persona tenga mas de un Domicilio
                  // $insertar_dom = insert_domicilio_sim($barrio,$calle,$altura,$depto,$otro_dato_domi);
                  // if($insertar_dom){

                  //   $id_dom = get_idDomicilio_sim();
                  //   $id_d = pg_fetch_array($id_dom);
                  //   $idDomicilio = $id_d['id_dom'];
                  //   //inserto persona_domicilio 
                  //   $insertar_per_dom = insert_personaDomicilio_sim($idPersona, $idDomicilio);
                  // }

            }

            if($insert_persona){
              $id_persona = get_idPersona($dni_persona);
              $id_p = pg_fetch_array($id_persona);
              $idPersona = $id_p['id_pers'];
              //inserto Persona Natural

              if ($tipo_per['tipo_per'] == 2){
                $insertar_perJuridica = insert_personasJuridica_sim($idPersona,$apeynom);
              }elseif ($tipo_per['tipo_per'] == 1) {
                $insertar_personaNat = insert_personasNatural_sim($idPersona,$apeynom,$fecha_nac,$id_sexo,$id_genero);
              }
              
              if($insertar_personaNat or $insertar_perJuridica){
                //inserto domicilio
                $insertar_dom = insert_domicilio_sim($barrio,$calle,$altura,$depto,$otro_dato_domi);

                if($insertar_dom){

                  $id_dom = get_idDomicilio_sim();
                  $id_d = pg_fetch_array($id_dom);
                  $idDomicilio = $id_d['id_dom'];
                  //inserto persona_domicilio 
                  $insertar_per_dom = insert_personaDomicilio_sim($idPersona, $idDomicilio);
                }
              }
            }
            
            
            $cantidad +=1;
              ?>
                <tr>
                   <td><?php echo $cantidad?></td>
                   <td><?php echo $dni_persona?></td>
                   <td><?php echo $apeynom?></td>
                   <td><?php echo $id_sexo . '->' .$sexo?></td>
                   <td><?php echo $id_genero . '->' .$genero?></td>
                   <td><?php echo $otro_dato_domi?></td>
                   <td><?php echo $nombre_juridico?></td>
                   <td><?php echo $cuil_tipo?></td>
                   <td><?php echo $cuil_digito?></td>
                   <td><?php echo $cuil_tipo?></td>
                   <td><?php echo $control_doc?></td>
                </tr>
           
              <?php 
      }
    }
  }

//cerrar conexion a la BD
pg_close(connection_200());

   
?>

</table>
</body>
</html>