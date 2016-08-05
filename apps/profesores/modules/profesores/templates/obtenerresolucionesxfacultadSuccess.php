<?php
if (count($resoluciones_profesores) > 0){
	//el bucle para cargar las opciones
	echo "<option value='0'>----Seleccione----</option>";
	foreach ($resoluciones_profesores as $rp){
		echo "<option value='".$rp['idresolucionprofesor']."'>".$rp['resolucionfecha']."</option>";
	}
}
?>
