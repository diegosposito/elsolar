<?php
if (count($llamados) > 0) {
		$arreglo_llamados= array();
	//el bucle para cargar las opciones
	foreach ($llamados as $llamado) {

		if(!in_array($llamado->getIdllamado(),$arreglo_llamados)) {
			array_push($arreglo_llamados,$llamado->getIdllamado());
			echo "<option value=".$llamado->getIdllamado()." >".$llamado->getLlamadosTurno()."</option>";
		};
	}
	
}
?>
