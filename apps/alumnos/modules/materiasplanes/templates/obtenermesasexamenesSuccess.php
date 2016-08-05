<?php
if (count($mesasexamenes) > 0){
	//el bucle para cargar las opciones
	foreach ($mesasexamenes as $mesaexamen){
		echo "<option value=".$mesaexamen->getIdmesaexamen().">".$mesaexamen."</option>";
	}
}else{
	echo "<option value='0' checked>----Seleccione----</option>";
}
?> 