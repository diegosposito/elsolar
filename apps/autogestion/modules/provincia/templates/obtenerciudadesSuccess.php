<?php
if (count($ciudades) > 0){
	//el bucle para cargar las opciones
	foreach ($ciudades as $ciudad){
		echo "<option value=".$ciudad->getIdciudad().">".$ciudad->getDescripcion()."</option>";
	}
}
?>