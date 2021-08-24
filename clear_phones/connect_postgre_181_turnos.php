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

      $query1 = "SELECT cp.id_persona, tp.apyn, tp.tel_contacto FROM turnos.personas tp
                  INNER JOIN cidig.persona cp ON cp.cuil_documento = tp.documento::text
                  WHERE (cp.id_persona NOT IN 
                  (SELECT ctp.id_persona FROM cidig.telefono_persona ctp) AND (tp.tel_contacto IS NOT NULL))";
      

      $personas = pg_query($db, $query1);
      

      if(!$personas) {
         echo pg_last_error($db);
         exit;
      }


      while($persona = pg_fetch_array($personas)) {

         $id_persona = $persona['id_persona'];
         $apyn = $persona['apyn'];
         $telefono = $persona['tel_contacto'];
         $telefono_corregido = exec("python clear_phone.py '".$telefono."'");
         $leyenda = "-->Verificar/Corregir";


         if(strlen($telefono_corregido) > 10){

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
         }

      }
      //cerrar conexion a la BD
      pg_close($db);

   }
?>

</table>
</body>
</html>


