<?php
if (count($fechas) > 0) {
	//el bucle para cargar las opciones
	foreach ($fechas as $fecha) {
		echo "<option value=".$fecha.">".$fecha."</option>";
	}
}
?>