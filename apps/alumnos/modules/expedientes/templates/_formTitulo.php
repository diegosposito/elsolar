<script>
$(document).ready(function(){
	$("#expedientes_egresados_fechaenviome").datepicker({
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

	$("#expedientes_egresados_fecharecibidome").datepicker({
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

	$("#expedientes_egresados_fechaentregatitulo").datepicker({
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
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('expedientes/guardartitulo') ?>" method="post">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?> 
      <tr>
        <td><?php echo $form['observaciones']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['nrorecibo2']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['nrorecibo2']->renderError() ?>
          <?php echo $form['nrorecibo2'] ?>
        </td>
      </tr>   
      <tr>
        <td width="22%"><?php echo $form['fechaenviome']->renderLabel() ?></td>
        <td width="20%">
          <?php echo $form['fechaenviome']->renderError() ?>
          <?php echo $form['fechaenviome'] ?>
        </td>
        <td width="23%"><?php echo $form['fecharecibidome']->renderLabel() ?></td>
        <td width="35%">
          <?php echo $form['fecharecibidome']->renderError() ?>
          <?php echo $form['fecharecibidome'] ?>
        </td>        
      </tr>
      <tr>
        <td><?php echo $form['registrodiplomame']->renderLabel() ?></td>
        <td>
          <?php echo $form['registrodiplomame']->renderError() ?>
          <?php echo $form['registrodiplomame'] ?>
        </td>
        <td><?php echo $form['registrocertificadome']->renderLabel() ?></td>
        <td>
          <?php echo $form['registrocertificadome']->renderError() ?>
          <?php echo $form['registrocertificadome'] ?>
        </td>        
      </tr>
      <tr>
        <td><?php echo $form['fechaentregatitulo']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['fechaentregatitulo']->renderError() ?>
          <?php echo $form['fechaentregatitulo'] ?>
        </td>
      </tr>      
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/indextitulos') ?>'"></p>
<br>	
