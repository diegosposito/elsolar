<?php
if (count($mesasexamenes) > 0){
	//el bucle para cargar las opciones
	foreach ($mesasexamenes as $mesaexamen){
		echo "<option value='".$mesaexamen->idmesaexamen."'>".$mesaexamen->fecha." - ".$mesaexamen->hora."</option>";
	}
}
?>