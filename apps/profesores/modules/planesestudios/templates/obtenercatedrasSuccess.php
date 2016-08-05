<?php
if (count($catedras) > 0){
	//el bucle para cargar las opciones
	foreach ($catedras as $catedra){
		echo "<option value='".$catedra->idcatedra."'>".$catedra->getMateriasPlanes()." (".$catedra->getCurso().")</option>";
	}
}
?>
