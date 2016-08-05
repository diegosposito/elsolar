<script>
$(document).ready(function(){
    $('#comisiones_idcatedra').change(function(){  
    	$.post("<?php echo url_for('comisiones/obtenernombre'); ?>",
    	    { idcatedra: $('#comisiones_idcatedra').val() },
    	    function(data){
            	$("#comisiones_nombre").val(data);            	        	    
        	}
        );
    });   
});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('comisiones/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idcomision='.$form->getObject()->getIdcomision().'&idplanestudio='.$idplanestudio : '?idplanestudio='.$idplanestudio)) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
          	<?php if ($form->getObject()->getActivo()) { ?>
          	&nbsp;<?php echo link_to('Desactivar', 'comisiones/activar?idcomision='.$form->getObject()->getIdcomision().'&activo=0') ?>
            <?php } else { ?>
            &nbsp;<?php echo link_to('Activar', 'comisiones/activar?idcomision='.$form->getObject()->getIdcomision().'&activo=1') ?>
            <?php } ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="15%"><?php echo $form['idcatedra']->renderLabel() ?></td>
        <td colspan="3">
			<select id="comisiones_idcatedra" name="comisiones[idcatedra]">
			<?php foreach ($catedras as $catedra) { ?>
				<option value="<?php echo $catedra['idcatedra'] ?>" <?php if ($catedra['idcatedra'] == $idcatedra) { ?>selected<?php } ?>><?php echo $catedra['nombre']."(".$catedra['curso'].")" ?></option>
			<?php } ?>
			</select>        
        </td>
      </tr>        
      <tr>
        <td width="15%"><?php echo $form['nombre']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>  
      <tr>
        <td width="15%"><?php echo $form['descripcion']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>        
      <tr>
        <td><?php echo $form['capacidad']->renderLabel() ?></td>
        <td>
          <?php echo $form['capacidad']->renderError() ?>
          <?php echo $form['capacidad'] ?>
        </td>
        <td  width="23%"><?php echo $form['inscripcionhabilitada']->renderLabel() ?></td>
        <td>
          <?php echo $form['inscripcionhabilitada']->renderError() ?>
          <?php echo $form['inscripcionhabilitada'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['letrainicio']->renderLabel() ?></td>
        <td>
          <?php echo $form['letrainicio']->renderError() ?>
          <?php echo $form['letrainicio'] ?>
        </td>
        <td><?php echo $form['letrafin']->renderLabel() ?></td>
        <td>
          <?php echo $form['letrafin']->renderError() ?>
          <?php echo $form['letrafin'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['turno']->renderLabel() ?></td>
        <td>
          <?php echo $form['turno']->renderError() ?>
          <?php echo $form['turno'] ?>
        </td>
        <td><?php echo $form['idestadocomision']->renderLabel() ?></td>
        <td>
          <?php echo $form['idestadocomision']->renderError() ?>
          <?php echo $form['idestadocomision'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('comisiones/index?idplanestudio='.$sf_user->getAttribute('idplanestudio').'&idsede='.$sf_user->getAttribute('idsede')) ?>'"></p>
<br>