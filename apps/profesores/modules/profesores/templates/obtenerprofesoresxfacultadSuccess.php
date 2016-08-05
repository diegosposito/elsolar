<?php
if (count($profesores) > 0){
	//el bucle para cargar las opciones
	echo "<option value='0'>----Seleccione----</option>";
	foreach ($profesores as $rp){
		echo "<option value='".$rp['idpersona']."'>".$rp['profesor']."</option>";
	}
}
?>