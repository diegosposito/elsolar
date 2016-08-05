<?php
if (count($materias) > 0){
	//el bucle para cargar las opciones
	foreach ($materias as $materia){
		echo "<option value=".$materia->idmateriaplan.">".$materia->nombre." (".$materia->curso.")</option>";
	}
}else{
	echo "<option value='0' checked>----Seleccione----</option>";
}
?>