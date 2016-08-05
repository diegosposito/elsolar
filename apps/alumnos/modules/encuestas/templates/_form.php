<script>
$(document).ready(function(){
	$("#encuestas_fecha").datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
		buttonImageOnly: true,
		defaultDate: new Date(),
		dateFormat: 'yy-mm-dd',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
});
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('encuestas/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idencuesta='.$form->getObject()->getIdencuesta() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="60%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'encuestas/delete?idencuesta='.$form->getObject()->getIdencuesta(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="20%"><?php echo $form['idcarrera']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idcarrera']->renderError() ?>
          <?php echo $form['idcarrera'] ?>
        </td>
      </tr> 
      <tr>
        <td><?php echo $form['nombre']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr> 
      <tr>
        <td><?php echo $form['descripcion']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
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
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('encuestas/index') ?>'"></p>
<br>