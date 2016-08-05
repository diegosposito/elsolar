<?php
if (count($profesores) > 0){
	//el bucle para cargar las opciones
	foreach ($profesores as $profesor){
		echo "<option value=".$profesor->idprofesor.">".$profesor->getPersonas()."</option>";
	}
}
?>
