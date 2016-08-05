<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
{
  "idpersona": <?php echo $id_persona; ?>,
  "idusuario": <?php echo $id_usuario; ?>  
  
}