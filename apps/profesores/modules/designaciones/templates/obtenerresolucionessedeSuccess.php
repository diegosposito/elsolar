<?php
if (count($resoluciones) > 0){
	//el bucle para cargar las opciones
	foreach ($resoluciones as $rp){
		echo "<option value='".$rp['idresolucionprofesor']."'>".$rp['resolucionfecha']."</option>";
	}
}
?>