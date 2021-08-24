<!DOCTYPE html>
<html>
<head>
   <title></title>
</head>
<body>
   <table width="70%" border="1px" align="center">
   <tr>
      <td><b>id_persona</b></td>
      <td><b>apyn</b></td>
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

      $query1 = "SELECT DISTINCT(te_p.id_persona), te_p.apyn, 
               te_p.cel_contacto, te_p.tel_contacto 
               FROM territorio.personas te_p
               INNER JOIN cidig.persona cp ON cp.id_persona = te_p.id_persona 

              WHERE ( 
              (te_p.id_persona NOT IN (SELECT tp.id_persona FROM cidig.telefono_persona tp)) 
              AND  (te_p.cel_contacto IS NOT NULL OR te_p.tel_contacto IS NOT NULL) 
              ) ORDER BY te_p.id_persona ASC";
      

      $personas = pg_query($db, $query1);
      

      if(!$personas) {
         echo pg_last_error($db);
         exit;
      }


      while($persona = pg_fetch_array($personas)) {

         $id_persona = $persona['id_persona'];
         $apyn = $persona['apyn'];

         //Verifica cual de los 2 campos de telefono del registro tiene contenido y lo guarda en la variable
         if ($persona['cel_contacto'] != null) {
            $telefono = $persona['cel_contacto'];
         }else{
            $telefono = $persona['tel_contacto'];
         }

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

         /*if(($telefono_corregido != null) and (strlen($telefono_corregido) <=10)){

               $id_telefono_tipo = exec("python phone_code.py  '" . $telefono_corregido ."' ");

               $insert_phone_query = "INSERT INTO 
                 cidig.telefono_persona (id_telefono_tipo, id_persona, numero, id_estado, observaciones)
                 VALUES ('$id_telefono_tipo', '$id_persona', '$telefono_corregido', 1, '')";

               $insert_phone = pg_query($db, $insert_phone_query);

               if(!$insert_phone){
                  echo pg_last_error($db);
                  exit;
               }     
         } */ 

      }
      //cerrar conexion a la BD
      pg_close($db);

   }
?>

</table>
</body>
</html>