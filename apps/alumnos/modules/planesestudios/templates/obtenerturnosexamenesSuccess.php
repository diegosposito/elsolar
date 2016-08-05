<?php
if (count($turnos) > 0){
	//el bucle para cargar las opciones
	foreach ($turnos as $turno){
		echo "<option value=".$turno->idfecha.">".$turno->descripcion."</option>";
	}
}
?>