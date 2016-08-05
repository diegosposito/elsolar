<?php
if (count($planes) > 0){
	//el bucle para cargar las opciones
	echo "<option value='0' selected='selected' >----TODOS----</option>";
	foreach ($planes as $plan){
		echo "<option value=".$plan->getIdplanestudio().">".$plan."</option>";
	}
}
?>  