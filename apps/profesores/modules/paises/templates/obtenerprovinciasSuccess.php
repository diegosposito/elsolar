<?php
if (count($provincias) > 0){
	//el bucle para cargar las opciones
	foreach ($provincias as $provincia){
		echo "<option value=".$provincia->getIdprovincia().">".$provincia->getDescripcion()."</option>";
	}
}
?>