<br>

<h1>Editar Designaciones</h1> 
<h2>Profesor : <?php echo $oPersona->getApellido().', '.$oPersona->getNombre() ?></h2>

<br>

<?php 

include_partial('formEditarDesignacion', 
array('form' => $form, 'iddesignacion' => $iddesignacion, 'idplanestudio' => $idplanestudio, 'idsede' => $idsede, 'idprofesor' => $idprofesor, 'msgError' => $msgError))

?>
