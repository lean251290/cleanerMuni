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

      $query1 = "SELECT cp.id_persona, cc.apyn, cc.telefonos FROM sac.ciudadanos cc 
            INNER JOIN cidig.persona cp ON cp.cuil_documento = cc.documento::text
            WHERE (cp.id_persona NOT IN 
            (SELECT ctp.id_persona FROM cidig.telefono_persona ctp) AND (cc.telefonos IS NOT NULL))
            LIMIT 300";
      

      $personas = pg_query($db, $query1);
      

      if(!$personas) {
         echo pg_last_error($db);
         exit;
      }


      while($persona = pg_fetch_array($personas)) {

         $id_persona = $persona['id_persona'];
         $apyn = $persona['apyn'];
         $telefono = $persona['telefonos'];
         $telefono_corregido = exec("python clear_phone.py '".$telefono."'");
         $leyenda = "-->Verificar/Corregir";


        // if(strlen($telefono_corregido) > 10){

?>
            <tr>
               <td><?php echo $id_persona?></td>
               <td><?php echo $apyn?></td>
               <td><?php echo $telefono?></td>
               <td><?php echo $telefono_corregido?></td>
               <td><?php echo $leyenda?></td>
               <td><?php echo $id_persona?></td>
            </tr>
         
<?php 
      //}

         if(($telefono_corregido != null) and (strlen($telefono_corregido) <=10)){

               $id_telefono_tipo = exec("python phone_code.py  '" . $telefono_corregido ."' ");

               $insert_phone_query = "INSERT INTO 
                 cidig.telefono_persona (id_telefono_tipo, id_persona, numero, id_estado, observaciones)
                 VALUES ('$id_telefono_tipo', '$id_persona', '$telefono_corregido', 1, '')";

               $insert_phone = pg_query($db, $insert_phone_query);

               if(!$insert_phone){
                  echo pg_last_error($db);
                  exit;
               }     
         }   

      }
      //cerrar conexion a la BD
      pg_close($db);

   }
?>

</table>
</body>
</html>