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
      <td><b>apyn</b></td>
      <td><b>telefono</b></td>
      <td><b>telefono_corregido</b></td>
      <td><b>leyenda</b></td>
      <td><b>id_corregir</b></td>

   </tr>
<?php
   
   

   function empieza_con($string, $startString) { 
      $len = strlen($startString); 
      return (substr($string, 0, $len) === $startString); 
   }

   $db = pg_connect("$host $port $dbname $credentials $options");

   if(!$db) {
      echo "Error : No se pudo establecer la conexion a la base de datos: ";
      
   } else {

      /* $phone = "35354-        547657 ";
      $phone_clean = exec("python clear_phone.py '".$phone."'"); 
      echo $phone_clean;  */

      $query1 = "SELECT p.item, p.dni, p.apyn, p.telefono FROM public.persona p LIMIT 1000";
      

      $personas = pg_query($db, $query1);
      

      if(!$personas) {
         echo pg_last_error($db);
         exit;
      }


      while($persona = pg_fetch_array($personas)) {
         
         if($persona['dni'] != null && $persona['telefono'] != null){

            $id_persona = $persona['item'];
            $dni = $persona['dni'];
            $telefono = $persona['telefono'];
            $apyn = $persona['apyn'];
            $telefono_corregido = exec("python clear_phone.py '".$telefono."'");
            $leyenda = "";



?>
            <tr>
               <td><?php echo $id_persona?></td>
               <td><?php echo $dni?></td>
               <td><?php echo $apyn?></td>
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

            $insert_phone_query_cel = "INSERT INTO 
            public.telefono_persona (id_telefono_tipo, id_persona, numero, id_estado, observaciones)
            VALUES (3, '$id_persona', '$telefono_corregido', 1, '')";

            $insert_phone_query_fijo = "INSERT INTO 
            public.telefono_persona(id_telefono_tipo, id_persona, numero, id_estado, observaciones)
            VALUES (1, '$id_persona', '$telefono_corregido', 1, '')";

            if($telefono_corregido != ''){
               /*$insert_phone = pg_query($db, $insert_phone_query_cel);

               if(!isset($insert_phone)){
                  echo pg_last_error($db);
                  exit;
               }*/
               if(empieza_con($telefono_corregido, '4')){
                  $insert_phone = pg_query($db, $insert_phone_query_fijo);

               }else{
                  $insert_phone = pg_query($db, $insert_phone_query_cel);

               }

               if(!isset($insert_phone)){
                     echo pg_last_error($db);
                     exit;
                  }
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
