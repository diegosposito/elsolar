<?php
if (count($carreras) > 0){
	//el bucle para cargar las opciones
	echo "<option value='0' selected='selected' >----SELECCIONAR----</option>";
	foreach ($carreras as $carrera){
		echo "<option value=".$carrera->getIdcarrera().">".$carrera->getNombre()."</option>";
	}
}
?>