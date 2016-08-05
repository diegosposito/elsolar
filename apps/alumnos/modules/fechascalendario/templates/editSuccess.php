<h1>Editar Fecha</h1>
<?php if ($form->getObject()->getIdtipo()==7) { // Verifico si es de tipo turno de examen ?>
<?php include_component('fechascalendario', 'obtenerllamados', array('idfecha' => $form->getObject()->getIdfecha())) ?>
<?php } ?>
<?php include_partial('form', array('form' => $form, 'idcalendario' => $idcalendario)) ?>