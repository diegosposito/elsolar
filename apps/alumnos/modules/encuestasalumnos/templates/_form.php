<script>
$(document).ready(function(){
	$("#encuestas_alumnos_fecha").datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
		buttonImageOnly: true,
		defaultDate: new Date(),
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});

    $('#botonGuardar').click(function(){
    	$('#botonGuardar').attr("disabled", "disabled");
        // Guarda la solicitud de diploma
    	$.post("<?php echo url_for('encuestasalumnos/guardar'); ?>",
    	    $('#formGuardar').serialize() ,
    	    function(data){
    	    	alert(data);
    	    	$(location).attr('href','<?php echo url_for('encuestasalumnos/index?idalumno='.$alumno->getIdalumno()); ?>');
        	}
        );
    	return false;
   	});		
});
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" id="formGuardar" method="post">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="40%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'encuestasalumnos/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
          <?php endif; ?>
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" id="botonGuardar" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="40%"><?php echo $form['idencuesta']->renderLabel() ?></td>
        <td>
          <?php echo $form['idencuesta']->renderError() ?>
          <?php echo $form['idencuesta'] ?>
        </td>
      </tr> 
      <tr>
        <td><?php echo $form['fecha']->renderLabel() ?></td>
        <td>
          <?php echo $form['fecha']->renderError() ?>
          <?php echo $form['fecha'] ?>
        </td>
      </tr>       
    </tbody>
  </table>
</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('encuestasalumnos/index?idalumno='.$alumno->getIdalumno()) ?>'"></p>
<br>