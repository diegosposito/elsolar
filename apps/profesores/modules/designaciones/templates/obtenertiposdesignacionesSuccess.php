<?php
if (count($designaciones_tipos) > 0){
	//el bucle para cargar las opciones
	foreach ($designaciones_tipos as $dt){
		echo "<option value='".$dt['idtipodesignacion']."'>".$dt['descripcion']."</option>";
	}
}
?>
