<br>

<h1>Ver Designaciones</h1> 
<h2>Profesor : <?php echo $oPersona->getApellido().', '.$oPersona->getNombre() ?></h2>

<br>

<?php 

include_partial('formVerdesignacion', 
array('form' => $form, 'idplanestudio' => $idplanestudio, 'idsede' => $idsede, 'resultado' => $resultado, 'idpersona' => $idpersona, 'msgError' => $msgError, 'msgSuccess' => $msgSuccess))

?>
