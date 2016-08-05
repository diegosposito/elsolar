<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('areascargos/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'areascargos/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td><?php echo $form['idtipoarea']->renderLabel() ?></td>
        <td>
          <?php echo $form['idtipoarea']->renderError() ?>
          <?php echo $form['idtipoarea'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idtipocargo']->renderLabel() ?></td>
        <td>
          <?php echo $form['idtipocargo']->renderError() ?>
          <?php echo $form['idtipocargo'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('areascargos/index') ?>'"></p>
<br>