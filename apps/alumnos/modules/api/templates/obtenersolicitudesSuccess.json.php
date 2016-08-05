<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
{"records":[
<?php  
$cont = 1;
foreach ($solicitudes as $solicitud) { 
	$fecha = explode(" ",$solicitud->getUpdatedAt());
	$arr = explode('-', $fecha[0]);
	$fechaActualizacion = $arr[2]."-".$arr[1]."-".$arr[0];	
?>
 
{  
  "idsolicitud": "<?php echo $solicitud->getId(); ?>",
  "solicitud": "<?php echo substr(htmlspecialchars_decode($solicitud->getDescripcion()),0, 50); ?>",
  "respuesta": "<?php echo substr(htmlspecialchars_decode($solicitud->getRespuesta()),0, 50); ?>",
  "resuelta": "<?php echo ( $solicitud->getResuelta() == 1 ) ? 'Si' : 'No'; ?>",
  "fechaactualizacion": "<?php echo $fechaActualizacion; ?>"     
<?php 
	echo "}" . ( $cont == count($solicitudes) ? '' : ',') ?>
<?php  
	$cont++;
} ?>

]}