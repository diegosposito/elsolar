<script>
$(document).ready(function(){
    $.post("<?php echo url_for('planesestudios/obtenermaterias'); ?>",
    	    { idplanestudio: <?php echo $idplanorigen; ?> },
    	    function(data){
	    	    $('#transiciones_materias_idmateriaorigen').html(data);
	    	    if($('#transiciones_materias_idmateriaorigen option:selected').val()==0) {  
	    	    	$('#transiciones_materias_idmateriaorigen').attr('disabled',true);
	    	    	$('#botonGuardar').attr('disabled',true);
		    	}
	    	}
	);
    $.post("<?php echo url_for('planesestudios/obtenermaterias'); ?>",
    	    { idplanestudio: <?php echo $idplandestino; ?> },
    	    function(data){
	    	    $('#transiciones_materias_idmateriadestino').html(data);
	    	    if($('#transiciones_materias_idmateriadestino option:selected').val()==0) {  
	    	    	$('#transiciones_materias_idmateriadestino').attr('disabled',true);
	    	    	$('#botonGuardar').attr('disabled',true);
		    	}
    	    }
	);	
}); 
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('transicionesmaterias/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idtransicionmateria='.$form->getObject()->getIdtransicionmateria() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'transicionesmaterias/delete?idtransicionmateria='.$form->getObject()->getIdtransicionmateria(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" id="botonGuardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="15%"><?php echo $form['idmateriaorigen']->renderLabel() ?></td>
        <td>
          <?php echo $form['idmateriaorigen']->renderError() ?>
          <?php echo $form['idmateriaorigen'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['valormateria']->renderLabel() ?></td>
        <td>
          <?php echo $form['valormateria']->renderError() ?>
          <?php echo $form['valormateria'] ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['idmateriadestino']->renderLabel() ?></td>
        <td>
          <?php echo $form['idmateriadestino']->renderError() ?>
          <?php echo $form['idmateriadestino'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('transicionesmaterias/index?idtransicionplan='.$idtransicionplan) ?>'"></p>
<br>