<?php
if (count($niveles_estudios) > 0){
	//el bucle para cargar las opciones
	foreach ($niveles_estudios as $ne){
		echo "<option value=".$ne->getIdNivelEstudio().">".$ne->getDescripcion()."</option>";
	}
}
?>