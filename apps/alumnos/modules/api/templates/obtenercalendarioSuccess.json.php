<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
{"records":[
<?php 
$cont = 1;
foreach ($fechas as $fecha) { 
	$fechaInicio = new DateTime($fecha->getInicio());
	$inicio = $fechaInicio->format('d-m-Y');
	
	$fechaFin = new DateTime($fecha->getFin());
	$fin = $fechaFin->format('d-m-Y');

	if (($fecha->getFin() >= date("Y-m-d")) or (($fecha->getFin() < date("Y-m-d")) and (!in_array($fecha->getIdtipo(), array(4,5,6,12))))) {
?>

{  
  "id": <?php echo $fecha->getIdfecha(); ?>,
  "descripcion": "<?php echo $fecha->getDescripcion(); ?>",
  "tipo": "<?php echo $fecha->getTiposFechasCalendario(); ?>",
  "inicio": "<?php echo $inicio; ?>",     
  "fin": "<?php echo $fin; ?>"
<?php 
	echo "}" . ( $cont == count($fechas) ? '' : ',') ?>
<?php  
	}
	$cont++;
} ?>

]}