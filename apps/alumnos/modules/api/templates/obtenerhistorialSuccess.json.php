<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
{"records":[
<?php  
$arregloMateriasAprobadas = array();
$cont = 1;
foreach ($alu_mats as $alu_mat) { 
	if($alu_mat->getIdestadomateria()==9) {
		array_push($arregloMateriasAprobadas,$alu_mat->getIdCatedra());
	}	
	
	if(!in_array($alu_mat->getIdCatedra(),$arregloMateriasAprobadas) or ($alu_mat->getIdestadomateria()==9)) {	
		$arr = explode('-', $alu_mat->getFecha());
		$fechaRegistro = $arr[2]."-".$arr[1]."-".$arr[0];
			
		$arr = explode('-', $alu_mat->getFechavencimiento());
		$fechaVencimiento = $arr[2]."-".$arr[1]."-".$arr[0];
?>

{  
  "nombre": "<?php echo $alu_mat->getCatedras()->getMateriasPlanes()." (".$alu_mat->getCatedras()->getIdmateriaplan().")"; ?>",
  "curso": "<?php echo $alu_mat->getCatedras()->getMateriasPlanes()->getAnodecursada(); ?>",
  "fecha": "<?php echo $fechaRegistro; ?>",
  "fechavencimiento": "<?php if($alu_mat->getIdestadomateria()==3) echo $fechaVencimiento; ?>",     
  "estado": "<?php echo $alu_mat->getEstadosMateria(); ?>"
<?php 
	echo "}" . ( $cont == count($alu_mats) ? '' : ',') ?>
<?php  
	}
	$cont++;
} ?>

]}