<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('empleados/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idempleado='.$form->getObject()->getIdempleado() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Guardar" id="botonGuardar"/>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="10%"><b>Empleado:</b></td>
        <td>
          <?php echo $persona ?>
        </td>
      </tr> 
      <tr>
        <td width="10%"><b><?php echo $form['legajo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['legajo']->renderError() ?>
          <?php echo $form['legajo'] ?>
        </td>
      </tr>               
      <tr>
        <td><b><?php echo $form['activo']->renderLabel() ?></b></td>
        <td>
          <?php echo $form['activo']->renderError() ?>
          <?php echo $form['activo'] ?>
        </td>
      </tr>    
    </tbody>
  </table>
</form>
</div>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('empleados/index') ?>'"></p>
<br>