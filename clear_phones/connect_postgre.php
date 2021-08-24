<!DOCTYPE html>
<html>
<head>
   <title></title>
</head>
<body>
   <table width="70%" border="1px" align="center">
   <tr>
      <td><b>id_persona</b></td>
      <td><b>documento</b></td>
      <td><b>telefono</b></td>
      <td><b>telefono_corregido</b></td>
      <td><b>leyenda</b></td>
      <td><b>id_corregir</b></td>

   </tr>
<?php
   

   $db = pg_connect("$host $port $dbname $credentials $options");

   if(!$db) {
      echo "Error : No se pudo establecer la conexion a la base de datos: ";
      
   } else {

      /* $phone = "35354-        547657 ";
      $phone_clean = exec("python clear_phone.py '".$phone."'"); 
      echo $phone_clean;  */

      $query1 = "SELECT pp.id_persona, pp.documento , cc.telefonos , pp.id_persona , pp.cel_contacto 
                  FROM turnos.personas pp
                  LEFT OUTER JOIN sac.ciudadanos cc ON cc.documento = pp.documento
                  WHERE LENGTH(cc.telefonos) > 10
                  LIMIT 200";
      

      $personas = pg_query($db, $query1);
      

      if(!$personas) {
         echo pg_last_error($db);
         exit;
      }


      while($persona = pg_fetch_array($personas)) {
         
         if($persona['documento'] != null && $persona['telefonos'] != null){

            $id_persona = $persona['id_persona'];
            $dni = $persona['documento'];
            $telefono = $persona['telefonos'];
            $telefono_corregido = exec("python clear_phone.py '".$telefono."'");
            $leyenda = "";



?>
            <tr>
               <td><?php echo $id_persona?></td>
               <td><?php echo $dni?></td>
               <td><?php echo $telefono?></td>
               <td><?php echo $telefono_corregido?></td>
               <td>
               <?php 
               
               if(strlen($telefono_corregido) > 10){
                  $leyenda = "-->verificar/corregir";
                  echo $leyenda;
               }else{
                  echo '';
               }

               ?></td>

               <td>
               <?php 
               
               if(!empty($leyenda)){
                  echo $id_persona;
               }else{
                  echo '';
               }

               ?></td>
               
             </tr>
<?php 


            
         }
      }

      //cerrar conexion a la BD
      pg_close($db);

   }
?>

</table>
</body>
</html>


