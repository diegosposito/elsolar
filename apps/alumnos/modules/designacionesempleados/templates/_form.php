<script>
$(document).ready(function(){
	$('#botonGuardar').attr('disabled',true);
	<?php if (!$form->getObject()->isNew()) { ?>
	habilitarForm(false);
    $.post("<?php echo url_for('areas/obtenercargos'); ?>",
    	{ idarea: $('#designaciones_empleados_idarea').val() },
    	function(data){
    		$('#designaciones_empleados_idtipocargo').html(data);
    	}
   	);
  	<?php }else{ ?>   
  	habilitarForm(true);  	
  	<?php } ?>
	
	$('#designaciones_empleados_inicio').datepicker({
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

	$('#designaciones_empleados_fin').datepicker({
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

    $('#designaciones_empleados_idarea').change(function(){  
		habilitarForm(false);
		$('#botonGuardar').attr('disabled',false);
    	$('#designaciones_empleados_idtipocargo').attr('disabled',false);
	    $.post("<?php echo url_for('areas/obtenercargos'); ?>",
	    	{ idarea: $('#designaciones_empleados_idarea').val() },
	    	function(data){
	    		$('#designaciones_empleados_idtipocargo').html(data);
	    	}
    	);
    });   	
});

function habilitarForm(estado)
{
	$('#designaciones_empleados_idtipocargo').attr('disabled',estado);
	$('#designaciones_empleados_inicio').attr('disabled',estado);
	$('#designaciones_empleados_fin').attr('disabled',estado);
	$('#designaciones_empleados_titulo').attr('disabled',estado);
	$('#designaciones_empleados_activo').attr('disabled',estado);
	$('#designaciones_empleados_nroresolucion').attr('disabled',estado);
}
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('designacionesempleados/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'designacionesempleados/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
          <?php endif; ?>          
          <input type="submit" value="Guardar" id="botonGuardar"/>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="17%"><?php echo $form['idarea']->renderLabel() ?></td>
        <td>
          <?php echo $form['idarea']->renderError() ?>
          <?php echo $form['idarea'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idtipocargo']->renderLabel() ?></td>
        <td>
          <?php echo $form['idtipocargo']->renderError() ?>
          <?php echo $form['idtipocargo'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['inicio']->renderLabel() ?></td>
        <td>
          <?php echo $form['inicio']->renderError() ?>
          <?php echo $form['inicio'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['fin']->renderLabel() ?></td>
        <td>
          <?php echo $form['fin']->renderError() ?>
          <?php echo $form['fin'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['titulo']->renderLabel() ?></td>
        <td>
          <?php echo $form['titulo']->renderError() ?>
          <?php echo $form['titulo'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idsede']->renderLabel() ?></td>
        <td>
          <?php echo $form['idsede']->renderError() ?>
          <?php echo $form['idsede'] ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['activo']->renderLabel() ?></td>
        <td>
          <?php echo $form['activo']->renderError() ?>
          <?php echo $form['activo'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['nroresolucion']->renderLabel() ?></td>
        <td>
          <?php echo $form['nroresolucion']->renderError() ?>
          <?php echo $form['nroresolucion'] ?>
        </td>
      </tr>
      <tr>
        <td colspan="2">(*) Para su visualización en la impresión de Analíticos.</td>
      </tr>      
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('designacionesempleados/index?idempleado='.$idempleado) ?>'"></p>
<br>