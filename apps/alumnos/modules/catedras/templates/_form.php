<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('catedras/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idcatedra='.$form->getObject()->getIdcatedra() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('catedras/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'catedras/delete?idcatedra='.$form->getObject()->getIdcatedra(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idmateriaplan']->renderLabel() ?></th>
        <td>
          <?php echo $form['idmateriaplan']->renderError() ?>
          <?php echo $form['idmateriaplan'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idsede']->renderLabel() ?></th>
        <td>
          <?php echo $form['idsede']->renderError() ?>
          <?php echo $form['idsede'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['activa']->renderLabel() ?></th>
        <td>
          <?php echo $form['activa']->renderError() ?>
          <?php echo $form['activa'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
