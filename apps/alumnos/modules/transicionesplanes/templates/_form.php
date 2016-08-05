<script>
$(document).ready(function(){
	$("#transiciones_planes_idcarrera").change(function(){
		// Registra las notas en el Libro Matriz	
    	$.post("<?php echo url_for('carreras/obtenerplanes'); ?>",
    			{ idcarrera:$('#transiciones_planes_idcarrera').val(), version: 1 },
			function(data) {
    			$('#transiciones_planes_idplanorigen').attr('disabled',false);
    			$('#transiciones_planes_idplanorigen').html(data);     	
    			$('#transiciones_planes_idplandestino').attr('disabled',false);	
    			$('#transiciones_planes_idplandestino').html(data);
	   		}       			 	
		);		
	return false;
	});
}); 
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('transicionesplanes/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idtransicionplan='.$form->getObject()->getIdtransicionplan() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'transicionesplanes/delete?idtransicionplan='.$form->getObject()->getIdtransicionplan(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="22%"><?php echo $form['idcarrera']->renderLabel() ?></td>
        <td>
          <?php echo $form['idcarrera']->renderError() ?>
          <?php echo $form['idcarrera'] ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['idplanorigen']->renderLabel() ?></td>
        <td>
          <?php echo $form['idplanorigen']->renderError() ?>
          <?php echo $form['idplanorigen'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idplandestino']->renderLabel() ?></td>
        <td>
          <?php echo $form['idplandestino']->renderError() ?>
          <?php echo $form['idplandestino'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('transicionesplanes/index') ?>'"></p>
<br>