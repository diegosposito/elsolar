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
  "solicitud_permitida": <?php echo $solicitudpermitida; ?>,      
  "records":[
<?php  
$cont = 1;
foreach ($mesasdisponibles as $mesa) { 
?>

{  

  "id_mesa": <?php echo $mesa->getIdmesaexamen(); ?>,
  "nombre_materia": "<?php echo $mesa->getCatedras()->getMateriasPlanes()." (".$mesa->getIdcatedra().")"; ?>",
  "fecha_mesa": "<?php echo $mesa->getFecha(); ?>",
  "condicion_mesa": "<?php echo $mesa->getCondicionesMesas(); ?>"
<?php echo "}" . ( $cont == count($mesasdisponibles) ? '' : ',') ?>
<?php  
	$cont++;
} ?>
]}