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
      <td><b>direccion</b></td>
      <td><b>barrio</b></td>

   </tr>
<?php

include 'data_cleaner.php';
include 'query_base_pro.php';

if(!connection_200()) {
  echo "Error : No se pudo establecer la conexion a la base de datos: ";
  
}else {

    
      $personas = filtro_sube200_cidig_200();
      
      if(!empty($personas)){
        while ($persona = pg_fetch_array($personas)) {

          $id_persona = ultimoReg_idPersona();
          $id_p = pg_fetch_array($id_persona);
          $count_persona = $id_p['ult_idper'] + 1;

          $dni_persona = $persona['dni'];
          
          $apellido = pg_escape_string($persona['apellido']);
          $nombres = pg_escape_string($persona['nombres']);

          $apyn = strtoupper($apellido) . ', ' . ucwords(strtolower($nombres));

          $sexo = pg_escape_string($persona['sexo']);
          $direccion = pg_escape_string($persona['direccion']); 
          $barrio = pg_escape_string($persona['barrio']);
          $id_tipo_documento = 1;

          if($sexo == 'M'){
            $id_sexo = 1;
          }else{
            $id_sexo = 2;
          }

          $insert_persona = insert_personas_cidig200($dni_persona, $id_tipo_documento);

          if($insert_persona){
            //artilugio para calcular el id autoincremental de cidig_pablo.persona_natural
            $id_persona_nat = ultimoReg_idPersonaNat();
            $id_persona_natural = pg_fetch_array($id_persona_nat);
            $cont_per_nat = $id_persona_natural['ult_idper_nat'] + 1;

            //inserto Persona Natural
            $insertar_personaNat = insert_personas_natural200($count_persona, $apyn, $id_sexo);
          }
          
          

?>
            <tr>
               <td><?php echo $count_persona?></td>
               <td><?php echo $dni_persona?></td>
               <td><?php echo $apyn?></td>
               <td><?php echo $id_sexo . '->' .$sexo?></td>
               <td><?php echo $direccion?></td>
               <td><?php echo $barrio?></td>
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