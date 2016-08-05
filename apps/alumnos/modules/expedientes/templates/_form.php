<script>
$(document).ready(function(){
	$("#expedientes_egresados_fechainformeauditoria").datepicker({
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

<form action="<?php echo url_for('expedientes/guardar?idexpediente='.$form->getObject()->getIdexpediente()) ?>" method="post">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="15%"><?php echo $form['folio']->renderLabel() ?></td>
        <td>
          <?php echo $form['folio']->renderError() ?>
          <?php echo $form['folio'] ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['fechainformeauditoria']->renderLabel() ?></td>
        <td>
          <?php echo $form['fechainformeauditoria']->renderError() ?>
          <?php echo $form['fechainformeauditoria'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['documentacion']->renderLabel() ?></td>
        <td>
          <?php echo $form['documentacion']->renderError() ?>
          <?php echo $form['documentacion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['otradocumentacion']->renderLabel() ?></td>
        <td>
          <?php echo $form['otradocumentacion']->renderError() ?>
          <?php echo $form['otradocumentacion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['condicion']->renderLabel() ?></td>
        <td>
          <?php echo $form['condicion']->renderError() ?>
          <?php echo $form['condicion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['observaciones']->renderLabel() ?></td>
        <td>
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('expedientes/indexauditoria') ?>'"></p>
<br>	
