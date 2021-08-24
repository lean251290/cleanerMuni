<!DOCTYPE html>
<html>
<head>
   <title></title>
</head>
<body>
   <table width="70%" border="1px" align="center">
   <tr>
      <td><b>contador</b></td>
      <td><b>dni</b></td>
      <td><b>id_persona</b></td>
   </tr>
<?php

include 'query_update_idpersona.php';

$cantidad =0;

if(!connection_200()) {
  echo "Error : No se pudo establecer la conexion a la base de datos: ";
  
}else {

        $personas  = tribunalExp_Fisica();

        if(!empty($personas)){
          while ($persona = pg_fetch_array($personas)) {

            $dni_persona = $persona['dni'];
            $id_persona = $persona['cid_idpersona'];

            if(!is_null($dni_persona)){
              //Setea el id_persona (de la tabla origen) que obtiene del SIM
              $update_idpersona =update_idpersona_tribunal_jc_expediente($dni_persona,$id_persona);

            } 

            $cantidad +=1;
              ?>
                <tr>
                   <td><?php echo $cantidad?></td>
                   <td><?php echo $dni_persona?></td>
                   <td><?php echo $id_persona?></td>
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