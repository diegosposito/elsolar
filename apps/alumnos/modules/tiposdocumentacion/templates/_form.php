<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('tiposdocumentacion/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idtipodocumentacion='.$form->getObject()->getIdtipodocumentacion() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'tiposdocumentacion/delete?idtipodocumentacion='.$form->getObject()->getIdtipodocumentacion(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="15%"><?php echo $form['nombre']->renderLabel() ?></td>
        <td>
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>
      <tr>
        <td width="15%"><?php echo $form['nombrereducido']->renderLabel() ?></td>
        <td>
          <?php echo $form['nombrereducido']->renderError() ?>
          <?php echo $form['nombrereducido'] ?>
        </td>
      </tr>      
      <tr>
        <td width="15%"><?php echo $form['aplicable']->renderLabel() ?></td>
        <td>
          <?php echo $form['aplicable']->renderError() ?>
          <?php echo $form['aplicable'] ?>
        </td>
      </tr>
      <tr>
        <td width="15%"><?php echo $form['orden']->renderLabel() ?></td>
        <td>
          <?php echo $form['orden']->renderError() ?>
          <?php echo $form['orden'] ?>
        </td>
      </tr>      
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('tiposdocumentacion/index') ?>'"></p>
<br>