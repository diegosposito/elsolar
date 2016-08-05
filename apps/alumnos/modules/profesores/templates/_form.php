<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('profesores/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idprofesor='.$form->getObject()->getIdprofesor() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('profesores/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'profesores/delete?idprofesor='.$form->getObject()->getIdprofesor(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['idpersona']->renderLabel() ?></th>
        <td>
          <?php echo $form['idpersona']->renderError() ?>
          <?php echo $form['idpersona'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['idfacultad']->renderLabel() ?></th>
        <td>
          <?php echo $form['idfacultad']->renderError() ?>
          <?php echo $form['idfacultad'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['legajo']->renderLabel() ?></th>
        <td>
          <?php echo $form['legajo']->renderError() ?>
          <?php echo $form['legajo'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
