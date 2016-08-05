<script>
/**$(document).ready(function(){
	$('#carreras_fechacreacion').datepicker({
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
});**/
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('carreras/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idcarrera='.$form->getObject()->getIdcarrera() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'carreras/delete?idcarrera='.$form->getObject()->getIdcarrera(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="22%"><?php echo $form['nombre']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['nombrereducido']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['nombrereducido']->renderError() ?>
          <?php echo $form['nombrereducido'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idfacultad']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idfacultad']->renderError() ?>
          <?php echo $form['idfacultad'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idmodalidad']->renderLabel() ?></td>
        <td>
          <?php echo $form['idmodalidad']->renderError() ?>
          <?php echo $form['idmodalidad'] ?>
        </td>        
        <td><?php echo $form['idtipocarrera']->renderLabel() ?></td>
        <td>
          <?php echo $form['idtipocarrera']->renderError() ?>
          <?php echo $form['idtipocarrera'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['termino']->renderLabel() ?></td>
        <td>
          <?php echo $form['termino']->renderError() ?>
          <?php echo $form['termino'] ?>
        </td>      
        <td><?php echo $form['nroresolucioncsu']->renderLabel() ?></td>
        <td>
          <?php echo $form['nroresolucioncsu']->renderError() ?>
          <?php echo $form['nroresolucioncsu'] ?>
        </td>
      </tr>        
      <tr>
        <td><?php echo $form['nroresolucionhcd']->renderLabel() ?></td>
        <td>
          <?php echo $form['nroresolucionhcd']->renderError() ?>
          <?php echo $form['nroresolucionhcd'] ?>
        </td>      
        <td><?php echo $form['nroexpediente']->renderLabel() ?></td>     
		<td>
          <?php echo $form['nroexpediente']->renderError() ?>
          <?php echo $form['nroexpediente'] ?>
        </td>
      </tr>   
      <tr>
        <td><?php echo $form['nroresolucion']->renderLabel() ?></td>
        <td>
          <?php echo $form['nroresolucion']->renderError() ?>
          <?php echo $form['nroresolucion'] ?>
        </td>      
        <td><?php echo $form['idestadocarrera']->renderLabel() ?></td>
        <td>
          <?php echo $form['idestadocarrera']->renderError() ?>
          <?php echo $form['idestadocarrera'] ?>
        </td>      
      </tr>           
      <tr>
        <td><?php echo $form['anioinicio']->renderLabel() ?></td>
        <td>
          <?php echo $form['anioinicio']->renderError() ?>
          <?php echo $form['anioinicio'] ?>
        </td>      
        <td><?php echo $form['nroresolucionconeau']->renderLabel() ?></td>
        <td>
          <?php echo $form['nroresolucionconeau']->renderError() ?>
          <?php echo $form['nroresolucionconeau'] ?>
        </td>
      </tr>   
      <tr>
        <td colspan="6">(*) Campos obligatorios.</td>
      </tr>           
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('carreras/index') ?>'"></p>
<br>