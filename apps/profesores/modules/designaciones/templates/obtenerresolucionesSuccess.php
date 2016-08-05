<?php
if (count($resoluciones_profesores) > 0){
	//el bucle para cargar las opciones
	foreach ($resoluciones_profesores as $rp){
		echo "<option value='".$rp['idresolucionprofesor']."'>".$rp['resolucion']."</option>";
	}
}
?>
