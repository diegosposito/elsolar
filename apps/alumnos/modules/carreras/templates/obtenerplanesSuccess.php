<?php
if (count($planes) > 0){
	//el bucle para cargar las opciones
	foreach ($planes as $plan){
		if ($version == 1) {
			echo "<option value=".$plan->idplanestudio.">".$plan->nombre." - v".$plan->version."</option>";
		} else {
			echo "<option value=".$plan->idplanestudio.">".$plan->nombre."</option>";	
		}
		
	}
}
?>