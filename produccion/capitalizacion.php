<!DOCTYPE html>
<html>
<head>
   <title></title>
</head>
<body>
   <table width="70%" border="1px" align="center">
   <tr>
      <td><b>id_persona</b></td>
      <td><b>id_persona</b></td>
      <td><b>dni</b></td>
      <td><b>apyn</b></td>
      <td><b>Cidig apyn</b></td>
      <td><b>capitalizacion</b></td>
   </tr>
<?php

include 'data_cleaner.php';
include 'query_base_pro.php';

$cantidad =0;

if(!connection181()) {
  echo "Error : No se pudo establecer la conexion a la base de datos: ";
  
}else {


        //$personas = filtro_capApyn_personaNat();
        $personas = filtroSac_capApyn_personaNat();
      
      if(!empty($personas)){
        while ($persona = pg_fetch_array($personas)) {

          // $id_persona = ultimoReg_idPersona();
          // $id_p = pg_fetch_array($id_persona);
          // $count_persona = $id_p['ult_idper'] + 1;
          $idPersona = $persona['idpersona'];
          $dni_persona = $persona['dni'];
          $apyn = pg_escape_string($persona['apyn']);
          $cidigApyn =pg_escape_string($persona['cidigapyn']);
        
          // $apellido = pg_escape_string($persona['apellido']);
          // $nombres = pg_escape_string($persona['nombres']);
          // $apyn = strtoupper($apellido) . ', ' . ucwords(strtolower($nombres));

          
          $apellido = strstr($cidigApyn, ',', true);
          $nombres = strstr($cidigApyn, ',');
          $apeynomMay = strtoupper($apellido).ucwords(strtolower($nombres));
          if (!empty($apeynomMay)){
            $apeynom = $apeynomMay;
          }else {
            $apellido = strstr($cidigApyn, ' ', true);
            $nombres = strstr($cidigApyn, ' ');
            if(!empty($apellido) && !empty($nombres)){
                $apeynom = strtoupper($apellido) .','. ucwords(strtolower($nombres));

              }else{
                $apeynom = $cidigApyn;
            }
            
          }
          //$apeynom = ucwords(strtolower($apyn));
          //$update_personaNatApyn = update_capApyn_PersonaNatural($idPersona,$apeynom);
          
          
$cantidad +=1;
?>
            <tr>
               <td><?php echo $cantidad?></td>
               <td><?php echo $idPersona?></td>
               <td><?php echo $dni_persona?></td>
               <td><?php echo $apyn?></td>
               <td><?php echo $cidigApyn?></td>
               <td><?php echo $apeynom?></td>
              
            </tr>
         
<?php 

      }
    }
  }

//cerrar conexion a la BD
pg_close(connection181());

   
?>

</table>
</body>
</html>