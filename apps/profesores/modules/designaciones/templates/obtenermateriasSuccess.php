<?php
if (count($catedras) > 0){
	//el bucle para cargar las opciones
	foreach ($catedras as $materia){
		echo "materia ".$materia->idcatedra.$materia->materia;
		echo "<option value=".$materia->idcatedra.">".$materia->materia."</option>";
	}
}
?>