<?php
if (count($llamados) > 0){
	//el bucle para cargar las opciones
	foreach ($llamados as $llamado){
		echo "<option value=".$llamado->idllamado.">".$llamado->descripcion."</option>";
	}
}
?>