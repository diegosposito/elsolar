<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
{"records":[
<?php 
$cont = 1;
foreach ($carreras_inscripto as $carrera) { 
?>

{  
  "id": <?php echo $carrera->idalumno; ?>,
  "nombre": "<?php echo $carrera->nombrecarrera; ?>"
<?php 
	echo "}" . ( $cont == count($carreras_inscripto) ? '' : ',') ?>
<?php  
	$cont++;
} ?>

]}