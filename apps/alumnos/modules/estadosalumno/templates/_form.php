<script>
$(document).ready(function(){
	$("#estados_alumno_historial_fecha").datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
	
    $('#botonGuardar').click(function(){
    	$('#botonGuardar').attr("disabled","disabled").delay(5000);
        // cargar las designaciones para dicha mesa de examen
    	$.post("<?php echo url_for('estadosalumno/guardaryenviar'); ?>",
    	    $('#formGuardar').serialize() ,
    	    function(data){
    	    	alert(data);
    	    	$(location).attr('href','<?php echo url_for('estadosalumno/index?idalumno='.$alumno->getIdalumno().'&idcarrera='.$alumno->getIdplanestudio()); ?>');
        	}
        );
    	window.setTimeout( function(){ $('#botonGuardar').removeAttr("disabled") }, 5000 );
    	return false;
   	});	
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div align="center">
<form action="" id="formGuardar" method="post">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="80%">
      <thead>
		<tr>
			<td width="15%"><b>Plan de estudio:</b></td>
			<td><?php echo $alumno->getPlanesEstudios(); ?></td>
		</tr>
		<tr>
			<td><b>Alumno:</b></td>
			<td><?php echo $alumno->getPersonas(); ?></td>
		</tr>
		<tr>
			<td><b>Nro. Documento:</b></td>
			<td><?php echo $alumno->getPersonas()->getNrodoc(); ?></td>
		</tr>		
    </thead>
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" id="botonGuardar" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="20%"><b><?php echo $form['fecha']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['fecha']->renderError() ?>
          <?php echo $form['fecha'] ?>
        </td>
      </tr> 
      <tr>
        <td width="20%"><b><?php echo $form['observaciones']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr>       
    </tbody>
  </table>
</form>
</div>	
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('estadosalumno/index?idcarrera='.$alumno->getIdplanestudio().'&idalumno='.$alumno->getIdalumno()) ?>'"></p>
<br>