<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
{
  "estado_libredeuda": <?php echo $estadolibredeuda; ?>,
  "periodo_habilitado": <?php echo $periodohabilitado; ?>,
  "activo": <?php echo $activo; ?>,
  "estado_documentacion": <?php echo $estadodocumentacion; ?>,
  "documentacion_habilitada": <?php echo $documentacionhabilitada; ?>,  
  "entrega_encuesta": <?php echo $entregaencuesta; ?>,
  "solicitud_permitida": <?php echo $solicitudpermitida; ?>,      
  "records":[
<?php 
$cont = 1;
foreach ($materiashabilitadas as $materia_plan) { 
	if (($materia_plan->getMateriasPlanes()->getPeriododecursada()==$periododecursada) || ($materia_plan->getMateriasPlanes()->getPeriododecursada()==0)) {
		$comisiones = $materia_plan->obtenerComisiones($idsede);
?>

{  

  "id_materia": <?php echo $materia_plan->getIdmateriaplan(); ?>,
  "nombre_materia": "<?php echo $materia_plan->getMateriasPlanes(); ?>",
  "anodecursada": "<?php echo $materia_plan->getMateriasPlanes()->getAnodecursada(); ?>",
  "comisiones":[
<?php 
$comi = 1;
foreach($comisiones as $comision) { ?>
  		{
  		"id_comision": <?php echo $comision->getIdcomision(); ?>,
  		"nombre_comision": "<?php echo $comision->getNombre(); ?>"
		<?php echo "}" . ( $comi == count($comisiones) ? '' : ',') ?>
<?php 
	$comi++;
} 
?>  			
  ]
<?php echo "}" . ( $cont == count($materiashabilitadas) ? '' : ',') ?>
<?php  
	}
	$cont++;
} ?>
]}