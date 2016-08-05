<script>
$(document).ready(function(){
	$('#asignaciones_clases_horainicio').attr('readonly', true);
	$('#asignaciones_clases_horafin').attr('readonly', true);
	
   $('#asignaciones_clases_horainicio').timepicker({
       showLeadingZero: false,
       onSelect: tpStartSelect,
       maxTime: {
           hour: 22, minute: 00
       }
   });
   $('#asignaciones_clases_horafin').timepicker({
       showLeadingZero: false,
       onSelect: tpEndSelect,
       minTime: {
           hour: 7, minute: 00
       }
   });
	
    $('#botonGuardar').click(function() {
   	
    	// guardar la informacion de contacto del aspirante ingresada
		$.post("<?php echo url_for('asignacionesclases/validar'); ?>",
   		   	$('#formGuardar').serialize(),
   			function(data){
   				if (data){
   					$.post("<?php echo url_for('asignacionesclases/guardar'); ?>",
   				   		$('#formGuardar').serialize(),
						function(data){
							alert(data);
							$(location).attr('href',"<?php echo url_for('asignacionesclases/index?idcomision='.$sf_user->getAttribute('idcomision').'&idciclolectivo='.$sf_user->getAttribute('idciclolectivo')) ?>");	 
						}
   				   	);
   	   			}else{
   	   				if (confirm('Ya existe una comision o mesa de examen asignada. Desea continuar?')) {
	   	   				$.post("<?php echo url_for('asignacionesclases/guardar'); ?>",
	   	   		   		   	$('#formGuardar').serialize(),
	   	   		   			function(data){
	   	   			    	   	alert(data);
	   	   			    	   	$(location).attr('href',"<?php echo url_for('asignacionesclases/index?idcomision='.$sf_user->getAttribute('idcomision').'&idciclolectivo='.$sf_user->getAttribute('idciclolectivo')) ?>");	 
	   	   					}
	   	   		   		);
   	   	         	}
   	   	   	   	}
			}
   		);
		return false;
   	});	   	
});

//when start time change, update minimum for end timepicker
function tpStartSelect( time, endTimePickerInst ) {
   $('#asignaciones_clases_horafin').timepicker('option', {
       minTime: {
           hour: endTimePickerInst.hours,
           minute: endTimePickerInst.minutes
       }
   });
}

// when end time change, update maximum for start timepicker
function tpEndSelect( time, startTimePickerInst ) {
   $('#asignaciones_clases_horainicio').timepicker('option', {
       maxTime: {
           hour: startTimePickerInst.hours,
           minute: startTimePickerInst.minutes
       }
   });
}
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="" method="post" id="formGuardar" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'asignacionesclases/delete?idasignacion='.$form->getObject()->getIdasignacion(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>          
          <input type="submit" value="Guardar" id="botonGuardar"/>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="10%"><?php echo $form['idaula']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idaula']->renderError() ?>
          <?php echo $form['idaula'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['dia']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['dia']->renderError() ?>
          <?php echo $form['dia'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['inicio']->renderLabel() ?></td>
        <td>
          <?php echo $form['inicio']->renderError() ?>
          <?php echo $form['inicio'] ?>
        </td>
        <td><?php echo $form['fin']->renderLabel() ?></td>
        <td>
          <?php echo $form['fin']->renderError() ?>
          <?php echo $form['fin'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['horainicio']->renderLabel() ?></td>
        <td>
          <?php echo $form['horainicio']->renderError() ?>
          <?php echo $form['horainicio'] ?>    
        </td>
        <td><?php echo $form['horafin']->renderLabel() ?></td>
        <td>
          <?php echo $form['horafin']->renderError() ?>
          <?php echo $form['horafin'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idtipoclase']->renderLabel() ?></td>
        <td>
          <?php echo $form['idtipoclase']->renderError() ?>
          <?php echo $form['idtipoclase'] ?>
        </td>
        <td><?php echo $form['periodicidad']->renderLabel() ?></td>
        <td>
          <?php echo $form['periodicidad']->renderError() ?>
          <?php echo $form['periodicidad'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['observaciones']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr>      
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('asignacionesclases/index?idcomision='.$sf_user->getAttribute('idcomision').'&idciclolectivo='.$sf_user->getAttribute('idciclolectivo')) ?>'"></p>
<br>