<?php
if (count($catedras) > 0){
	foreach ($catedras as $catedra){
		echo "<option value='".$catedra['idcatedra']."'>".$catedra['materia']."</option>";
	}
}
?>