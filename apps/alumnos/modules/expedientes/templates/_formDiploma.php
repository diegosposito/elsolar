<script>
$(document).ready(function(){
	$("#expedientes_egresados_fechasolicitud").datepicker({
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
    	$('#botonGuardar').attr("disabled", "disabled");
        // Guarda la solicitud de diploma
    	$.post("<?php echo url_for('expedientes/guardarsolicituddiploma'); ?>",
    	    $('#formGuardar').serialize() ,
    	    function(data){
    	    	alert(data);
    	    	$(location).attr('href','<?php echo url_for('expedientes/veregresado?idalumno='.$alumno->getIdalumno().'&idtitulo='.$titulo->getIdtitulo()); ?>');
        	}
        );
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
  <table cellspacing="0" class="stats" width="85%">
      <thead>
		<tr>
			<td width="19%"><b>Diploma que solicita:</b></td>
			<td>
			<?php 
			if ($alumno->getPersonas()->getIdsexo()==1) {
				echo $titulo->getNombre();	
			} else {
				echo $titulo->getNombrefemenino();
			}
			?>
			</td>
		</tr>      
		<tr>
			<td><b>Plan de estudio:</b></td>
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
        <td width="20%"><b><?php echo $form['fechasolicitud']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['fechasolicitud']->renderError() ?>
          <?php echo $form['fechasolicitud'] ?>
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
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/veregresado?idalumno='.$alumno->getIdalumno().'&idtitulo='.$titulo->getIdtitulo()) ?>'"></p>
<br>