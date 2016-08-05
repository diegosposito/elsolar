<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
{   
  "records":[
<?php 
$cont = 1;
$calendario = Doctrine_Core::getTable('Calendarios')->obtenerCalendario($alumno->getPlanesEstudios()->getCarreras()->getIdfacultad(), $alumno->getIdsede());
foreach ($mesasinscriptas as $mesa) { 
	//if(($mesa->getMesasExamenes()->getIdestadomesaexamen()==2)){
	//	if ($fechaactual <= $mesa->getMesasExamenes()->obtenerFechaCierre($plazoborrado, $calendario)) {
?>
 
{   

  "id_mesa": <?php echo $mesa->getMesasExamenes()->getIdmesaexamen(); ?>,
  "nombre_materia": "<?php echo $mesa->getMesasExamenes()->getCatedras()->getMateriasPlanes()." (".$mesa->getMesasExamenes()->getIdcatedra().")"; ?>",
  "fecha_mesa": "<?php echo $mesa->getMesasExamenes()->getFecha(); ?>",
  "condicion_mesa": "<?php echo $mesa->getMesasExamenes()->getCondicionesMesas(); ?>"

<?php echo "}" . ( $cont == count($mesasinscriptas) ? '' : ',') ?>
<?php  
		$cont++;
	//	}
//	}
} ?>
]}