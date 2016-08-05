<?php
if (count($cargos) > 0){
	//el bucle para cargar las opciones
	foreach ($cargos as $cargo){
		echo "<option value=".$cargo->idtipocargo.">".$cargo->descripcion."</option>";
	}
}
?>