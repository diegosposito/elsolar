<?php
if (count($comisiones) > 0) {
	//el bucle para cargar las opciones
	foreach ($comisiones as $comision) {
		echo "<option value=".$comision->idcomision.">".$comision->nombre."</option>";
	}
}
?>