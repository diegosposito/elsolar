<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
{   
  "periodo_habilitado": <?php echo $periodohabilitado; ?>,
  "periodo_de_cursada": <?php echo $periododecursada; ?>,
  "records":[
<?php 
$cont = 1;
foreach ($materiasinscriptas as $comision) { 
	if ($comision->getCatedras()->getMateriasPlanes()->getIdplanestudio()!=168) { 
?>
 
{  

  "id_materia": <?php echo $comision->getCatedras()->getIdmateriaplan(); ?>,
  "nombre_materia": "<?php echo $comision->getCatedras()->getMateriasPlanes(); ?>",
  "ano_de_cursada": "<?php echo $comision->getCatedras()->getMateriasPlanes()->getAnodecursada(); ?>",
  "periodo_de_cursada": "<?php echo $comision->getCatedras()->getMateriasPlanes()->getPeriododecursada(); ?>",
  "nombre_comision": "<?php echo $comision; ?>",  
  "cupo": "<?php echo $comision->obtenerCantidadInscriptos(); ?>/<?php echo $comision->getCapacidad(); ?>",  
  "id_alumno": <?php echo $alumno->getIdalumno(); ?>,
  "id_comision": <?php echo $comision->getIdcomision(); ?>  

<?php echo "}" . ( $cont == count($materiasinscriptas) ? '' : ',') ?>
<?php  
	$cont++;
	}
} ?>
]}