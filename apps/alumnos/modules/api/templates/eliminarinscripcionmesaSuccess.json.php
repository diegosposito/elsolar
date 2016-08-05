<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?> 
 
{
  "mensaje": "<?php echo $mensaje; ?>" 
  
}