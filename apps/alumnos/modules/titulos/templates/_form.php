<script>
$(document).ready(function(){
	$('#titulos_fechacreacion').datepicker({
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
	$('#titulos_fechacreacionministerial').datepicker({
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
	 
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('titulos/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idtitulo='.$form->getObject()->getIdtitulo() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'titulos/delete?idtitulo='.$form->getObject()->getIdtitulo(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="25%"><b><?php echo $form['nombre']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>
      <tr>
        <td><b><?php echo $form['nombrefemenino']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['nombrefemenino']->renderError() ?>
          <?php echo $form['nombrefemenino'] ?>
        </td>
      </tr>
      <tr>
        <td><b><?php echo $form['idtipotitulo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['idtipotitulo']->renderError() ?>
          <?php echo $form['idtipotitulo'] ?>
        </td>
        <td><b><?php echo $form['niveltitulo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['niveltitulo']->renderError() ?>
          <?php echo $form['niveltitulo'] ?>
        </td>
      </tr>
      <tr>
        <td><b><?php echo $form['nroresolucion']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['nroresolucion']->renderError() ?>
          <?php echo $form['nroresolucion'] ?>
        </td>
        <td><b><?php echo $form['fechacreacion']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['fechacreacion']->renderError() ?>
          <?php echo $form['fechacreacion'] ?>
        </td>
      </tr>
      <tr>
        <td><b><?php echo $form['fechacreacionministerial']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['fechacreacionministerial']->renderError() ?>
          <?php echo $form['fechacreacionministerial'] ?>
        </td>
      </tr>      
      <tr>
        <td><b><?php echo $form['incumbencias']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['incumbencias']->renderError() ?>
          <?php echo $form['incumbencias'] ?>
        </td>
      </tr>
      <tr>
        <td><b><?php echo $form['acreditacionconeau']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['acreditacionconeau']->renderError() ?>
          <?php echo $form['acreditacionconeau'] ?>
        </td>
        <td><b><?php echo $form['categorizacionconeau']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['categorizacionconeau']->renderError() ?>
          <?php echo $form['categorizacionconeau'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('titulos/index') ?>'"></p>
<br>