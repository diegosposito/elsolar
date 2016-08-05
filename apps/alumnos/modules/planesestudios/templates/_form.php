<script>
$(document).ready(function(){
	$('#planes_estudios_cantidadmaterias').attr('disabled','disabled');
	$('#planes_estudios_cantidadmaterias').val(parseFloat($('#planes_estudios_cantidadcomunes').val())+ parseFloat($('#planes_estudios_cantidadpreuniversitarias').val()) + parseFloat($('#planes_estudios_cantidadoptativas').val()) + parseFloat($('#planes_estudios_cantidadextracurriculares').val()) + parseFloat($('#planes_estudios_cantidadtesinas').val())+ parseFloat($('#planes_estudios_cantidadtpfinal').val()));
	
	$('#planes_estudios_fechaaprobacion').datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot(); ?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	}); 

	$('#planes_estudios_cantidadcomunes').change(function() {
		$('#planes_estudios_cantidadmaterias').val(parseFloat($('#planes_estudios_cantidadcomunes').val())+ parseFloat($('#planes_estudios_cantidadpreuniversitarias').val()) + parseFloat($('#planes_estudios_cantidadoptativas').val()) + parseFloat($('#planes_estudios_cantidadextracurriculares').val()) + parseFloat($('#planes_estudios_cantidadtesinas').val())+ parseFloat($('#planes_estudios_cantidadtpfinal').val()));
	});	 

	$('#planes_estudios_cantidadpreuniversitarias').change(function() {
		$('#planes_estudios_cantidadmaterias').val(parseFloat($('#planes_estudios_cantidadcomunes').val())+ parseFloat($('#planes_estudios_cantidadpreuniversitarias').val()) + parseFloat($('#planes_estudios_cantidadoptativas').val()) + parseFloat($('#planes_estudios_cantidadextracurriculares').val()) + parseFloat($('#planes_estudios_cantidadtesinas').val())+ parseFloat($('#planes_estudios_cantidadtpfinal').val()));
	});	

	$('#planes_estudios_cantidadoptativas').change(function() {
		$('#planes_estudios_cantidadmaterias').val(parseFloat($('#planes_estudios_cantidadcomunes').val())+ parseFloat($('#planes_estudios_cantidadpreuniversitarias').val()) + parseFloat($('#planes_estudios_cantidadoptativas').val()) + parseFloat($('#planes_estudios_cantidadextracurriculares').val()) + parseFloat($('#planes_estudios_cantidadtesinas').val())+ parseFloat($('#planes_estudios_cantidadtpfinal').val()));
	});			

	$('#planes_estudios_cantidadextracurriculares').change(function() {
		$('#planes_estudios_cantidadmaterias').val(parseFloat($('#planes_estudios_cantidadcomunes').val())+ parseFloat($('#planes_estudios_cantidadpreuniversitarias').val()) + parseFloat($('#planes_estudios_cantidadoptativas').val()) + parseFloat($('#planes_estudios_cantidadextracurriculares').val()) + parseFloat($('#planes_estudios_cantidadtesinas').val())+ parseFloat($('#planes_estudios_cantidadtpfinal').val()));
	});	

	$('#planes_estudios_cantidadtesinas').change(function() {
		$('#planes_estudios_cantidadmaterias').val(parseFloat($('#planes_estudios_cantidadcomunes').val())+ parseFloat($('#planes_estudios_cantidadpreuniversitarias').val()) + parseFloat($('#planes_estudios_cantidadoptativas').val()) + parseFloat($('#planes_estudios_cantidadextracurriculares').val()) + parseFloat($('#planes_estudios_cantidadtesinas').val())+ parseFloat($('#planes_estudios_cantidadtpfinal').val()));
	});	

	$('#planes_estudios_cantidadtpfinal').change(function() {
		$('#planes_estudios_cantidadmaterias').val(parseFloat($('#planes_estudios_cantidadcomunes').val())+ parseFloat($('#planes_estudios_cantidadpreuniversitarias').val()) + parseFloat($('#planes_estudios_cantidadoptativas').val()) + parseFloat($('#planes_estudios_cantidadextracurriculares').val()) + parseFloat($('#planes_estudios_cantidadtesinas').val())+ parseFloat($('#planes_estudios_cantidadtpfinal').val()));
	});	

    $('form#delete').submit(function() {
        var c = confirm("Confirma que desea guardar los cambios?");
        return c;
    });		
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="delete" action="<?php echo url_for('planesestudios/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idplanestudio='.$form->getObject()->getIdplanestudio() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
		  <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'planesestudios/delete?idplanestudio='.$form->getObject()->getIdplanestudio(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
	      <tr>
	        <td>
	        	<?php echo $form['nombre']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['nombre']->renderError() ?>	        	
	        	<?php echo $form['nombre']->render() ?>
	        </td>	
	        <td>
	        	<?php echo $form['version']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['version']->renderError() ?>	        
	        	<?php echo $form['version']->render() ?>
	        </td>		                
	      </tr>		  
	      <tr>
	        <td>
	        	<?php echo $form['letra']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['letra']->renderError() ?>	        
	        	<?php echo $form['letra']->render() ?>
	        </td>	
	        <td>
	        	Estado:
	        </td>
	        <td>
	        	<?php echo $estadoplan ?>
	        </td>		                
	      </tr>	
	      <tr>                
	        <td>
	        	<?php echo $form['modalidadalumnolibre']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['modalidadalumnolibre']->renderError() ?>	        
	        	<?php echo $form['modalidadalumnolibre']->render() ?>
	        </td>		                
	      </tr>		      
	      <tr>
	        <td>
	        	<b>Cantidad de asignaturas:</b>
	        </td>	
	        <td></td>	        
	        <td><b>Total:</b></td>
	        <td>
				<?php echo $form['cantidadmaterias']->render() ?>
	        </td>	                        
	      </tr>		
	      <tr>
	        <td>
	        	<?php echo $form['cantidadcomunes']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['cantidadcomunes']->renderError() ?>	        
	        	<?php echo $form['cantidadcomunes']->render() ?>
	        </td>	
	        <td>
	        	<?php echo $form['cantidadpreuniversitarias']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['cantidadpreuniversitarias']->renderError() ?>	        
	        	<?php echo $form['cantidadpreuniversitarias']->render() ?>
	        </td>		                
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['cantidadoptativas']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['cantidadoptativas']->renderError() ?>	        
	        	<?php echo $form['cantidadoptativas']->render() ?>
	        </td>		      
	        <td>
	        	<?php echo $form['cantidadextracurriculares']->renderLabel() ?>
	        </td>
	        <td>
	            <?php echo $form['cantidadextracurriculares']->renderError() ?>
	        	<?php echo $form['cantidadextracurriculares']->render() ?>
	        </td>		                
	      </tr>		
	      <tr>
	        <td>
	        	<?php echo $form['cantidadtesinas']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['cantidadtesinas']->renderError() ?>	        
	        	<?php echo $form['cantidadtesinas']->render() ?>
	        </td>	
	        <td>
	        	<?php echo $form['cantidadtpfinal']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['cantidadtpfinal']->renderError() ?>	        
	        	<?php echo $form['cantidadtpfinal']->render() ?>
	        </td>	                		        	      
	      </tr>		                 
	      <tr>
	        <td colspan="4">
	        	<b>Duración:</b>
	        </td>	                
	      </tr>	
	      <tr>
	        <td>
	        	<?php echo $form['duracionnumerica']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['duracionnumerica']->renderError() ?>	        
	        	<?php echo $form['duracionnumerica']->render() ?>
	        </td>	
	        <td>
	        	<?php echo $form['horastotales']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['horastotales']->renderError() ?>	        
	        	<?php echo $form['horastotales']->render() ?>
	        </td>		                
	      </tr>		 
	      <tr>
	        <td colspan="4">
	        	<b>Res. CSU de aprobación del plan de estudios vigente:</b>
	        </td>	                
	      </tr>		
	      <tr>
	        <td>
	        	<?php echo $form['nroresolucion']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['nroresolucion']->renderError() ?>	        
	        	<?php echo $form['nroresolucion']->render() ?>
	        </td>	
	        <td>
	        	<?php echo $form['fechaaprobacion']->renderLabel() ?>
	        </td>
	        <td>
          		<?php echo $form['fechaaprobacion']->renderError() ?>		        
	        	<?php echo $form['fechaaprobacion']->render() ?>
	        </td>		                
	      </tr>		
	      <tr>
	        <td colspan="4">(*) Campos obligatorios.</td>                
	      </tr>			                  		             	           	      	      	      	      	      	      	          
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('planesestudios/index?idcarrera='.$idcarrera) ?>'"></p>
<br>
