<br>

<h1>Crear Nuevas Designaciones</h1> 
<h2>Alumno : <?php echo $oPersona->getApellido().', '.$oPersona->getNombre() ?></h2>

<br>

<?php 

include_partial('formDesignar', 
array('form' => $form, 'idplanestudio' => $idplanestudio, 'idsede' => $idsede, 'idprofesor' => $idprofesor, 'msgError' => $msgError))

?>
