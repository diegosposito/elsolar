<?php
if (count($sedes) > 0){
	//el bucle para cargar las opciones
	foreach ($sedes as $sede){
		echo "<option value=".$sede->idsede.">".$sede->nombre."</option>";
	}
}
?>