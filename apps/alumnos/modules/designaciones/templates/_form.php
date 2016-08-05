<script>
$(document).ready(function(){
	$('#designaciones_inicio').datepicker({
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
	$('#designaciones_fin').datepicker({
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
	$('#designaciones_fechaaprobacion').datepicker({
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
	<?php if ($form->getObject()->getIddesignacion()) { 
		$idplanestudio = $form->getObject()->getCatedras()->getMateriasPlanes()->getIdplanestudio();
	?>
		habilitarForm(false);

		$('#designaciones_idcarrera').val(<?php echo $idplanestudio ?>);
    	// cargar las catedras de la carrera al combo
    	cargarComboCatedras('#designaciones_idcatedra', <?php echo $idplanestudio ?>, <?php echo $form->getObject()->getIdcatedra() ?>);
    	// cargar las profesores de la carrera al combo
    	cargarComboProfesores('#designaciones_idprofesor', <?php echo $idplanestudio ?>, <?php echo $form->getObject()->getIdprofesor() ?>);
	<?php }else { ?>
		cantidad = parseInt($('#designaciones_idcarrera').length);
		if(cantidad==1) {
	    	// cargar las catedras de la carrera al combo
	    	cargarComboCatedras('#designaciones_idcatedra', $('#designaciones_idcarrera').val(), 0);
		} else {
			habilitarForm(true);
		}
	<?php } ?>
	
    $('#designaciones_idcarrera').change(function(){
    	if($('#designaciones_idcarrera').val()!=0){
    		habilitarForm(false);
            // cargar las catedras de la carrera al combo
    		cargarComboCatedras('#designaciones_idcatedra', $(this).val(), 0);
            // cargar las profesores de la carrera al combo    		
    		cargarComboProfesores('#designaciones_idprofesor', $(this).val(), 0);
        }else{
            habilitarForm(true);
        }
    });	
    
	$('#botonGuardar').click(function(){
		// Guardar la designacion
    	$.post("<?php echo url_for('designaciones/guardar'); ?>",
    		$('#formGuardar').serialize(),
    	   	function(data){
        	   	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('designaciones/index'); ?>");	    	     	    	
        	}
		);
				
		return false;
	});     
});

function habilitarForm(estado) {
	$('#designaciones_idmateriaplan').attr('disabled',estado);
	$('#designaciones_idcatedra').attr('disabled',estado);
	$('#designaciones_idprofesor').attr('disabled',estado);
	$('#designaciones_idtipodesignacion').attr('disabled',estado);
	$('#designaciones_inicio').attr('disabled',estado);
	$('#designaciones_fin').attr('disabled',estado);
	$('#designaciones_fechaaprobacion').attr('disabled',estado);
}

//Cargar combo de catedras
function cargarComboCatedras(combo, id, idseleccionado) {
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
		{ idplanestudio: id },
		function(data){
			if (data){
				$(combo).html(data);
				$(combo).attr('disabled',false);
				$(combo).val(idseleccionado);	    	    	
			}else{
				$(combo).attr('disabled',true);
				$(combo).html("<option value='0' selected='selected' >----NINGUNA----</option>");
			}
		}
	);
} 

//Cargar combo de profesores
function cargarComboProfesores(combo, id, idseleccionado) {
    // cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('planesestudios/obtenerprofesores'); ?>",
		{ idplanestudio: id },
		function(data){
			if (data){
				$(combo).html(data);
				$(combo).attr('disabled',false);
				$(combo).val(idseleccionado);	    	    	
			}else{
				$(combo).attr('disabled',true);
				$(combo).html("<option value='0' selected='selected' >----NINGUNA----</option>");
			}
		}
	);
} 
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" id="formGuardar" method="post">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'designaciones/delete?iddesignacion='.$form->getObject()->getIddesignacion(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
          <?php endif; ?>
          <input type="button" id="botonGuardar" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="20%"><b><?php echo $form['idcarrera']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idcarrera']->renderError() ?>
          <?php echo $form['idcarrera'] ?>
        </td>
      </tr>
      <tr>
        <td width="20%"><b><?php echo $form['idcatedra']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idcatedra']->renderError() ?>
          <?php echo $form['idcatedra'] ?>
        </td>
      </tr>
      <tr>
        <td width="20%"><b><?php echo $form['idprofesor']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idprofesor']->renderError() ?>
          <?php echo $form['idprofesor'] ?>
        </td>
      </tr>      
      <tr>
        <td width="20%"><b><?php echo $form['idtipodesignacion']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idtipodesignacion']->renderError() ?>
          <?php echo $form['idtipodesignacion'] ?>
        </td>
      </tr>      
      <tr>
        <td width="20%"><b><?php echo $form['inicio']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['inicio']->renderError() ?>
          <?php echo $form['inicio'] ?>
        </td>
      </tr>      
      <tr>
        <td width="20%"><b><?php echo $form['fin']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['fin']->renderError() ?>
          <?php echo $form['fin'] ?>
        </td>
      </tr>
      <tr>
        <td width="20%"><b><?php echo $form['fechaaprobacion']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['fechaaprobacion']->renderError() ?>
          <?php echo $form['fechaaprobacion'] ?>
        </td>
      </tr>                              
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('designaciones/index') ?>'"></p>
<br>